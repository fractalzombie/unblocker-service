<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Enum;

enum ProcessState: string
{
    case Success = 'SUCCESS';
    case Failure = 'FAILURE';
}
