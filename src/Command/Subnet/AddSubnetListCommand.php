<?php

declare(strict_types=1);

/*
 * UnBlocker service for routers.
 *
 * (c) Mykhailo Shtanko <fractalzombie@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Command\Subnet;

use Fp\Collections\ArrayList;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnBlockerService\Domain\Common\Service\Manipulator\ClockManipulatorInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Publisher\EventPublisherInterface;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\AddEventMessage;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\NotifyEventMessage;

#[AsCommand('router:subnet:add', 'Update subnet list')]
final class AddSubnetListCommand extends Command
{
    public function __construct(
        private readonly SubnetRepositoryInterface $repository,
        private readonly EventPublisherInterface $publisher,
        private readonly ClockManipulatorInterface $clockManipulator,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $ui = new SymfonyStyle($input, $output);

        try {
            $ui->info('Fetching subnet list');

            $subnetList = ArrayList::collect(
                $this->repository->getByStates(SubnetState::Created, SubnetState::Updated, SubnetState::New)
            );

            $ui->info("Fetched {$subnetList->count()} subnets");
            $ui->info('Start send messages for adding subnets to router');

            $subnetList
                ->map(AddEventMessage::fromSubnet(...))
                ->appended(NotifyEventMessage::fromMessage(
                    "All {$subnetList->count()} subnets was sent to add in router",
                    $this->clockManipulator->nowAsFormatted(),
                ))->tap($this->publisher->publish(...))
            ;

            $ui->success('All messages was sent to event bus');

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $ui->error($e->getMessage());

            return self::FAILURE;
        }
    }
}
