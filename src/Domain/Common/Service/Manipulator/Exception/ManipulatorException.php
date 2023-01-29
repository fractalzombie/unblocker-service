<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Service\Manipulator\Exception;

use UnBlockerService\Domain\Common\Trait\CreatesFromThrowableTrait;

final class ManipulatorException extends \LogicException
{
    use CreatesFromThrowableTrait;

    private const MESSAGE_WHEN_NOT_SUPPORTED_TYPE = 'Type %s is not supported';

    public static function notSupportedType(string $typeName): self
    {
        return new self(sprintf(self::MESSAGE_WHEN_NOT_SUPPORTED_TYPE, $typeName));
    }
}
