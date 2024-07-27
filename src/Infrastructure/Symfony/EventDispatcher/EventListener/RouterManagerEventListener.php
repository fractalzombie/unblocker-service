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

namespace UnBlockerService\Infrastructure\Symfony\EventDispatcher\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use UnBlockerService\Domain\Common\Enum\ProcessState;
use UnBlockerService\Domain\Router\Logger\RouterManagerLoggerInterface;
use UnBlockerService\Infrastructure\Symfony\EventDispatcher\Event\RouterManagerEvent;

#[AsEventListener(RouterManagerEvent::class)]
final readonly class RouterManagerEventListener
{
    public function __construct(
        private RouterManagerLoggerInterface $logger,
    ) {}

    public function __invoke(RouterManagerEvent $event): void
    {
        match ($event->processState) {
            ProcessState::Success => $this->logger->info($event->subnet),
            ProcessState::Failure => $this->logger->error($event->subnet, $event->exception),
        };
    }
}
