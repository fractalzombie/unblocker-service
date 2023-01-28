<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Command;

use Fp\Collections\ArrayList;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnBlockerService\Subnet\Domain\Enum\SubnetState;
use UnBlockerService\Subnet\Domain\Publisher\EventPublisherInterface;
use UnBlockerService\Subnet\Domain\Repository\SubnetRepositoryInterface;
use UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Message\AddEventMessage;

#[AsCommand('router:subnet:add', 'Update subnet list')]
final class AddSubnetListCommand extends Command
{
    public function __construct(
        private readonly EventPublisherInterface $publisher,
        private readonly SubnetRepositoryInterface $repository,
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
                ->tap($this->publisher->publish(...))
            ;

            $ui->success('All messages was sent to event bus');

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $ui->error($e->getMessage());

            return $e->getCode();
        }
    }
}
