<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Symfony\EventDispatcher\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use UnBlockerService\Domain\Common\Enum\ProcessState;
use UnBlockerService\Domain\Subnet\Logger\DownloaderLoggerInterface;
use UnBlockerService\Infrastructure\Symfony\EventDispatcher\Event\DownloaderRequestEvent;

#[AsEventListener(DownloaderRequestEvent::class)]
final class DownloaderRequestEventListener
{
    public function __construct(
        private readonly DownloaderLoggerInterface $logger,
    ) {
    }

    public function __invoke(DownloaderRequestEvent $event): void
    {
        match ($event->processState) {
            ProcessState::Success => $this->logger->info($event->request, $event->response, $event->statusCode),
            ProcessState::Failure => $this->logger->error($event->request, $event->response, $event->statusCode, $event->exception),
        };
    }
}
