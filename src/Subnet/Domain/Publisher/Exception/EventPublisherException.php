<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Publisher\Exception;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Common\Domain\Traits\CreatesFromThrowableTrait;

#[Immutable]
final class EventPublisherException extends \LogicException
{
    use CreatesFromThrowableTrait;
}
