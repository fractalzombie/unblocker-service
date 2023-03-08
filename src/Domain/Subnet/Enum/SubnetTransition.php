<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Enum;

enum SubnetTransition: string
{
    public const CREATE = 'create';
    public const UPDATE = 'update';
    public const ADD = 'add';
    public const NOTIFY = 'notify';

    case Create = 'create';
    case Update = 'update';
    case Add = 'add';
    case Notify = 'notify';
}
