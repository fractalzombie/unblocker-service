<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Enum;

enum DateTimeType: string
{
    case Created = 'created';
    case Updated = 'updated';
}
