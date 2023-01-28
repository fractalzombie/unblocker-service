<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Enum;

enum EventType: string
{
    public const CREATE = 'subnet.'.SubnetTransition::CREATE;
    public const UPDATE = 'subnet.'.SubnetTransition::UPDATE;
    public const ADD = 'subnet.'.SubnetTransition::ADD;

    case Create = self::CREATE;
    case Update = self::UPDATE;
    case Add = self::ADD;
}