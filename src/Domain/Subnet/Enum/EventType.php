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

enum EventType: string
{
    case Create = self::CREATE;
    case Update = self::UPDATE;
    case Add = self::ADD;
    case Notify = self::NOTIFY;

    public const string CREATE = SubnetState::STATE_NAME.SubnetTransition::CREATE;
    public const string UPDATE = SubnetState::STATE_NAME.SubnetTransition::UPDATE;
    public const string ADD = SubnetState::STATE_NAME.SubnetTransition::ADD;
    public const string NOTIFY = SubnetState::STATE_NAME.SubnetTransition::NOTIFY;
}
