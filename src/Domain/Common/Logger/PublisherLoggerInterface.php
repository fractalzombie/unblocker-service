<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Logger;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Infrastructure\Monolog\Logger\PublisherLogger;

#[AsAlias(PublisherLogger::class)]
interface PublisherLoggerInterface
{
}
