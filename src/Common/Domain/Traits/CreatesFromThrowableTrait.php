<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Domain\Traits;

trait CreatesFromThrowableTrait
{
    public static function fromThrowable(\Throwable $previous): self
    {
        return new self($previous->getMessage(), $previous->getCode(), $previous);
    }
}
