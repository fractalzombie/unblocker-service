<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Trait;

trait CreatesFromThrowableTrait
{
    public static function fromThrowable(\Throwable $previous): self
    {
        return new self($previous->getMessage(), $previous->getCode(), $previous);
    }
}
