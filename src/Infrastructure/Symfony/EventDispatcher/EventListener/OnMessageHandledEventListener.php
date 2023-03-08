<?php

declare(strict_types=1);

/*
 * UnBlocker service for routers.
 *
 * (c) Mykhailo Shtanko <fractalzombie@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Infrastructure\Symfony\EventDispatcher\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Messenger\Event\WorkerMessageHandledEvent;
use UnBlockerService\Domain\Common\Logger\HandlerLoggerInterface;

#[AsEventListener(WorkerMessageHandledEvent::class)]
class OnMessageHandledEventListener
{
    public function __construct(
        private readonly HandlerLoggerInterface $logger,
    ) {
    }

    public function __invoke(WorkerMessageHandledEvent $event): void
    {
        $this->logger->info($event);
    }
}
