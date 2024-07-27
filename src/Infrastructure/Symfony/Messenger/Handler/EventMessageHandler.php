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

namespace UnBlockerService\Infrastructure\Symfony\Messenger\Handler;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\EventMessageResolverInterface as TransitionEventResolver;

#[AsMessageHandler]
final readonly class EventMessageHandler
{
    public function __construct(
        private TransitionEventResolver $eventResolver,
    ) {}

    public function __invoke(EventMessage $message): void
    {
        $this->eventResolver->resolve($message);
    }
}
