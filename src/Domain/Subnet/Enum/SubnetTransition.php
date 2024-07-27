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

enum SubnetTransition: string
{
    case Create = self::CREATE;
    case Update = self::UPDATE;
    case Add = self::ADD;
    case Notify = self::NOTIFY;
    public const CREATE = 'create';
    public const UPDATE = 'update';
    public const ADD = 'add';
    public const NOTIFY = 'notify';
}
