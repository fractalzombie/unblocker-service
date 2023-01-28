<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Enum;

enum SubnetState: string
{
    public const STATE_NAME = 'subnet';
    public const NEW = 'new';
    public const CREATED = 'created';
    public const UPDATED = 'updated';
    public const ADDED = 'added';

    case New = self::NEW;
    case Created = self::CREATED;
    case Updated = self::UPDATED;
    case Added = self::ADDED;
}