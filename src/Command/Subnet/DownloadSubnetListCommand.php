<?php

declare(strict_types=1);

namespace UnBlockerService\Command\Subnet;

use Fp\Collections\ArrayList;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnBlockerService\Domain\Common\Service\Manipulator\ClockManipulatorInterface;
use UnBlockerService\Domain\Common\ValueObject\Provider;
use UnBlockerService\Domain\Subnet\Publisher\EventPublisherInterface;
use UnBlockerService\Domain\Subnet\Service\Downloader\DownloaderInterface;
use UnBlockerService\Domain\Subnet\Service\Downloader\Request\Request;
use UnBlockerService\Domain\Subnet\Service\Downloader\Serializer\ValueObject\Subnet;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\CreateEventMessage;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\NotifyEventMessage;

#[AsCommand('router:subnet:download', 'Update subnet list'), AsService(arguments: ['$providerList' => '%env(json:PROVIDER_LIST)%'])]
final class DownloadSubnetListCommand extends Command
{
    public function __construct(
        private readonly DownloaderInterface $downloader,
        private readonly EventPublisherInterface $publisher,
        private readonly ClockManipulatorInterface $clockManipulator,
        private readonly array $providerList,
    ) {
        parent::__construct();
    }

    protected function execute(InputInterface $input, OutputInterface $output): int
    {
        $ui = new SymfonyStyle($input, $output);

        try {
            $ui->info('Download subnet lists');

            $subnetList = ArrayList::collect($this->providerList)
                ->map(Provider::fromProvider(...))
                ->map(Request::fromProvider(...))
                ->map($this->downloader->download(...))
                ->reduce(array_merge(...))
                ->toArrayList(ArrayList::collect(...))
                ->unique(Subnet::unique(...))
            ;

            $ui->info("Downloaded {$subnetList->count()} subnets");
            $ui->info('Start send messages for adding subnets to database');

            $subnetList
                ->map(fn (Subnet $subnet) => CreateEventMessage::fromSubnet($subnet, $this->clockManipulator->now()))
                ->appended(NotifyEventMessage::fromMessage(
                    "All {$subnetList->count()} messages was sent to event bus",
                    $this->clockManipulator->nowAsFormatted(),
                ))->tap($this->publisher->publish(...))
            ;

            $ui->success("All {$subnetList->count()} messages was sent to event bus");

            return self::SUCCESS;
        } catch (\Throwable $e) {
            $ui->error($e->getMessage());

            return $e->getCode() ?: self::FAILURE;
        }
    }
}
