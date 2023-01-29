<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Exception;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Domain\Common\Trait\CreatesFromThrowableTrait;

#[Immutable]
final class EventResolverException extends \LogicException
{
    use CreatesFromThrowableTrait;
}
