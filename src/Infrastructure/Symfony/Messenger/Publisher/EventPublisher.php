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

namespace UnBlockerService\Infrastructure\Symfony\Messenger\Publisher;

use Symfony\Component\Messenger\MessageBusInterface;
use Symfony\Component\Messenger\Stamp\DispatchAfterCurrentBusStamp;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Publisher\EventPublisherInterface;
use UnBlockerService\Domain\Subnet\Publisher\Exception\EventPublisherException;

final readonly class EventPublisher implements EventPublisherInterface
{
    public function __construct(
        private MessageBusInterface $messageBus,
    ) {}

    public function publish(EventMessage $message): void
    {
        try {
            $this->messageBus->dispatch($message, [new DispatchAfterCurrentBusStamp()]);
        } catch (\Throwable $e) {
            throw EventPublisherException::fromThrowable($e);
        }
    }
}
