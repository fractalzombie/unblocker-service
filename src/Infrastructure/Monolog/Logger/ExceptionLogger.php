<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Monolog\Logger;

use FRZB\Component\DependencyInjection\Attribute\AsService;
use UnBlockerService\Domain\Common\Logger\ExceptionLoggerInterface;

#[AsService]
class ExceptionLogger implements ExceptionLoggerInterface
{
}
