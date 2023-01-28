<?php declare(strict_types=1);

namespace UnBlockerService\Router\Domain\Enum;

enum RouterType: string
{
    public const MIKROTIK = 'mikrotik';

    case Mikrotik = self::MIKROTIK;
}