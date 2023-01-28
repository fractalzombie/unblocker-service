<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Handler;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use UnBlockerService\Subnet\Domain\Message\EventMessage;
use UnBlockerService\Subnet\Domain\Service\TransitionEventResolver\EventMessageResolverInterface as TransitionEventResolver;

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
