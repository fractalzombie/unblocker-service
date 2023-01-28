<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Service\TransitionEventResolver\Exception;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Common\Domain\Traits\CreatesFromThrowableTrait;

#[Immutable]
final class EventMessageResolverException extends \LogicException
{
    use CreatesFromThrowableTrait;
}
