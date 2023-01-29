<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Publisher\Exception;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Domain\Common\Trait\CreatesFromThrowableTrait;

#[Immutable]
final class EventPublisherException extends \LogicException
{
    use CreatesFromThrowableTrait;
}
