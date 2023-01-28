<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Enum;

enum SubnetTransition: string
{
    public const CREATE = 'create';
    public const UPDATE = 'update';
    public const ADD = 'add';

    case Create = self::CREATE;
    case Update = self::UPDATE;
    case Add = self::ADD;
}