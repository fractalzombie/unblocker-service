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

namespace UnBlockerService\Domain\Common\Helper;

use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Platforms\MySQLPlatform;
use Doctrine\DBAL\Platforms\SQLitePlatform;
use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Domain\Common\Enum\DatabasePlatform;
use UnBlockerService\Infrastructure\Doctrine\Trait\PrivateConstructorTrait;

#[Immutable]
final class DatabaseHelper
{
    use PrivateConstructorTrait;

    public static function getPlatformFromDriver(string $platformClass): DatabasePlatform
    {
        return match ($platformClass) {
            SQLitePlatform::class => DatabasePlatform::SQLite,
            MySQLPlatform::class => DatabasePlatform::MySQL,
            default => throw new \RuntimeException(\sprintf('Unsupported database platform "%s"', $platformClass)),
        };
    }

    public static function getPlatformFromConnection(Connection $connection): DatabasePlatform
    {
        return self::getPlatformFromDriver($connection->getDriver()->getDatabasePlatform($connection)::class);
    }
}
