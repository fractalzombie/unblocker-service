<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Enum;

enum SubnetState: string
{
    case New = self::NEW;
    case Created = self::CREATED;
    case Updated = self::UPDATED;
    case Added = self::ADDED;

    public const STATE_NAME = 'subnet';
    public const NEW = 'new';
    public const CREATED = 'created';
    public const UPDATED = 'updated';
    public const ADDED = 'added';
}
