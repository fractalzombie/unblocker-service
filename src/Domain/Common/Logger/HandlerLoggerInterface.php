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

namespace UnBlockerService\Domain\Common\Logger;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\Messenger\Event\WorkerMessageFailedEvent;
use Symfony\Component\Messenger\Event\WorkerMessageHandledEvent;
use UnBlockerService\Infrastructure\Monolog\Logger\HandlerLogger;

#[AsAlias(HandlerLogger::class)]
interface HandlerLoggerInterface
{
    public function info(WorkerMessageHandledEvent $event): void;

    public function error(WorkerMessageFailedEvent $event): void;
}
