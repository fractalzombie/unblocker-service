<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Router\Logger;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Domain\Subnet\Entity\ReadOnlySubnetInterface;
use UnBlockerService\Infrastructure\Monolog\Logger\RouterManagerLogger;

#[AsAlias(RouterManagerLogger::class)]
interface RouterManagerLoggerInterface
{
    public function info(ReadOnlySubnetInterface $subnet): void;

    public function error(ReadOnlySubnetInterface $subnet, \Throwable $exception): void;
}
