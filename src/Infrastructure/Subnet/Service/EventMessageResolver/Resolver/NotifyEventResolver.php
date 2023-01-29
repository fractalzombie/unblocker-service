<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Subnet\Service\EventMessageResolver\Resolver;

use FRZB\Component\DependencyInjection\Attribute\AsService;
use FRZB\Component\DependencyInjection\Attribute\AsTagged;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\Exception\TransportExceptionInterface;
use Symfony\Component\Notifier\Message\ChatMessage;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Exception\EventMessageResolverException;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Resolver\EventResolverInterface;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\NotifyEventMessage;

#[AsService, AsTagged(EventResolverInterface::class)]
final readonly class NotifyEventResolver implements EventResolverInterface
{
    public function __construct(
        private ChatterInterface $chatter,
    ) {
    }

    public function __invoke(NotifyEventMessage $message): void
    {
        try {
            $this->chatter->send(new ChatMessage($message->message));
        } catch (TransportExceptionInterface $e) {
            throw EventMessageResolverException::fromThrowable($e);
        }
    }

    public function canResolve(EventMessage $message): bool
    {
        return $message instanceof NotifyEventMessage;
    }
}
