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

namespace UnBlockerService\Domain\Subnet\Enum;

use UnBlockerService\Infrastructure\Doctrine\Trait\PrivateConstructorTrait;

class ContextGroup
{
    use PrivateConstructorTrait;

    final public const string GENERAL_READ = 'general:read';
    final public const string GENERAL_WRITE = 'general:write';
    final public const string GENERAL_PATCH = 'general:patch';
    final public const string GENERAL_PUT = 'general:put';
    final public const string GENERAL_DELETE = 'general:delete';

    final public const array GENERAL_GROUP_LIST = [
        self::GENERAL_READ,
        self::GENERAL_WRITE,
        self::GENERAL_PATCH,
        self::GENERAL_PUT,
        self::GENERAL_DELETE,
    ];

    final public const array GENERAL_WRITE_LIST = [
        self::GENERAL_WRITE,
        self::GENERAL_PATCH,
        self::GENERAL_PUT,
        self::GENERAL_DELETE,
    ];

    final public const string SUBNET_READ = 'subnet:read';
    final public const string SUBNET_WRITE = 'subnet:write';
    final public const string SUBNET_PATCH = 'subnet:patch';
    final public const string SUBNET_PUT = 'subnet:put';
    final public const string SUBNET_DELETE = 'subnet:delete';

    final public const array SUBNET_GROUP_LIST = [
        self::SUBNET_READ,
        self::SUBNET_WRITE,
        self::SUBNET_PATCH,
        self::SUBNET_PUT,
        self::SUBNET_DELETE,
    ];

    final public const array SUBNET_WRITE_LIST = [
        self::SUBNET_WRITE,
        self::SUBNET_PATCH,
        self::SUBNET_PUT,
        self::SUBNET_DELETE,
    ];
}
