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
