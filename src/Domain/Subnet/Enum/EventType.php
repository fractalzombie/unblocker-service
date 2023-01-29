<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Enum;

use UnBlockerService\Domain\Subnet\Enum\SubnetTransition;

enum EventType: string
{
    case Create = self::CREATE;
    case Update = self::UPDATE;
    case Add = self::ADD;
    case Notify = self::NOTIFY;

    public const CREATE = 'subnet.'.SubnetTransition::CREATE;
    public const UPDATE = 'subnet.'.SubnetTransition::UPDATE;
    public const ADD = 'subnet.'.SubnetTransition::ADD;
    public const NOTIFY = 'subnet.'.SubnetTransition::NOTIFY;
}
