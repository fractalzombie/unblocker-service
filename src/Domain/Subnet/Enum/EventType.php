<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Enum;

use UnBlockerService\Domain\Subnet\Enum\SubnetTransition;

enum EventType: string
{
    case Create = 'subnet.create';
    case Update = 'subnet.update';
    case Add = 'subnet.add';
    case Notify = 'subnet.notify';

    public const CREATE = 'subnet.create';
    public const UPDATE = 'subnet.update';
    public const ADD = 'subnet.add';
    public const NOTIFY = 'subnet.notify';
}
