<?php

declare(strict_types=1);

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 *
 * Copyright (c) 2024 Mykhailo Shtanko fractalzombie@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE.MD
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Infrastructure\Subnet\Service\EventMessageResolver\Resolver;

use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\Notifier\ChatterInterface;
use Symfony\Component\Notifier\Exception\TransportExceptionInterface;
use Symfony\Component\Notifier\Message\ChatMessage;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Exception\EventMessageResolverException;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Resolver\EventResolverInterface;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\NotifyEventMessage;

#[Autoconfigure(lazy: EventResolverInterface::class), AutoconfigureTag(EventResolverInterface::class)]
final readonly class NotifyEventResolver implements EventResolverInterface
{
    public function __construct(
        private ChatterInterface $chatter,
    ) {}

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
