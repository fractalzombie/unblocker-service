<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Router\Service\Client\Mikrotik\Exception;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Domain\Common\Trait\CreatesFromThrowableTrait;

#[Immutable]
final class ClientException extends \LogicException
{
    use CreatesFromThrowableTrait;
}
