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
