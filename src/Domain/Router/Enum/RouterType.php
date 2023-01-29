<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Router\Enum;

enum RouterType: string
{
    case Mikrotik = self::MIKROTIK;

    public const MIKROTIK = 'mikrotik';
}
