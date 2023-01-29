<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Symfony\Messenger\Handler;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\EventMessageResolverInterface as TransitionEventResolver;

#[AsMessageHandler]
final readonly class EventMessageHandler
{
    public function __construct(
        private TransitionEventResolver $eventResolver,
    ) {
    }

    public function __invoke(EventMessage $message): void
    {
        $this->eventResolver->resolve($message);
    }
}
