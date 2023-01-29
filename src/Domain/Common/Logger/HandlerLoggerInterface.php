<?php

declare(strict_types=1);

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
