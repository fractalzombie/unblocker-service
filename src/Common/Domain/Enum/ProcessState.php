<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Domain\Enum;

enum ProcessState: string
{
    case Success = 'SUCCESS';
    case Failure = 'FAILURE';
}
