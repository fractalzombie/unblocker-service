<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Enum;

enum DateTimeType: string
{
    case Created = 'created';
    case Updated = 'updated';
}