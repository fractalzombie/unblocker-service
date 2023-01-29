<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Logger;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Infrastructure\Monolog\Logger\ListenerLogger;

#[AsAlias(ListenerLogger::class)]
interface ListenerLoggerInterface
{
}
