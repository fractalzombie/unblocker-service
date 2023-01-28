<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Command;

use Fp\Collections\ArrayList;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use Symfony\Component\Console\Attribute\AsCommand;
use Symfony\Component\Console\Command\Command;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;
use Symfony\Component\Console\Style\SymfonyStyle;
use UnBlockerService\Common\Domain\ValueObject\Provider;
use UnBlockerService\Subnet\Domain\Publisher\EventPublisherInterface;
use UnBlockerService\Subnet\Domain\Service\Downloader\DownloaderInterface;
use UnBlockerService\Subnet\Domain\Service\Downloader\Request\Request;
use UnBlockerService\Subnet\Domain\Service\Downloader\Serializer\ValueObject\Subnet;
use UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Message\CreateEventMessage;

#[AsCommand('router:subnet:download', 'Update subnet list'), AsService(arguments: ['$providerList' => '%env(json:PROVIDER_LIST)%'])]
final class DownloadSubnetListCommand extends Command
{
    public function __construct(
        private readonly DownloaderInterface $downloader,
        private readonly EventPublisherInterface $publisher,
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
                ->map(CreateEventMessage::fromSubnet(...))
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
