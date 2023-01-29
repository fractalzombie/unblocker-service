<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Symfony\EventDispatcher\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Messenger\Event\WorkerMessageFailedEvent;
use UnBlockerService\Domain\Common\Logger\HandlerLoggerInterface;

#[AsEventListener(WorkerMessageFailedEvent::class)]
class OnMessageFailedEventListener
{
    public function __construct(
        private readonly HandlerLoggerInterface $logger,
    ) {
    }

    public function __invoke(WorkerMessageFailedEvent $event): void
    {
        $this->logger->error($event);
    }
}
