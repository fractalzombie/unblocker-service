<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Enum;

enum SubnetState: string
{
    case New = 'new';
    case Created = 'created';
    case Updated = 'updated';
    case Added = 'added';

    public const STATE_NAME = 'subnet';
    public const NEW = 'new';
    public const CREATED = 'created';
    public const UPDATED = 'updated';
    public const ADDED = 'added';
}
