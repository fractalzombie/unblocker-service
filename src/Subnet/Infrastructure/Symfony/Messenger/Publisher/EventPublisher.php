<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Publisher;

use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;
use UnBlockerService\Subnet\Domain\Message\EventMessage;
use UnBlockerService\Subnet\Domain\Publisher\EventPublisherInterface;
use UnBlockerService\Subnet\Domain\Publisher\Exception\EventPublisherException;

final readonly class EventPublisher implements EventPublisherInterface
{
    public function __construct(
        private MessageBusInterface $messageBus,
    ) {
    }

    public function publish(EventMessage $message): void
    {
        try {
            $this->messageBus->dispatch($message, [new DispatchAfterCurrentBusStamp()]);
        } catch (\Throwable $e) {
            throw EventPublisherException::fromThrowable($e);
        }
    }
}
