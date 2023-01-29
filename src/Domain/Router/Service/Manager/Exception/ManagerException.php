<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Router\Service\Manager\Exception;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Domain\Common\Trait\CreatesFromThrowableTrait;

#[Immutable]
final class ManagerException extends \LogicException
{
    use CreatesFromThrowableTrait;

    private const MESSAGE_WHEN_THROWABLE = 'Exception for address %s: %s';
    private const MESSAGE_WHEN_ADD = 'Failure to add %s address: %s';
    private const MESSAGE_WHEN_UPDATE = 'Failure to update %s address: %s';
    private const MESSAGE_WHEN_REMOVE = 'Failure to remove %s address: %s';

    public static function fromAddressAndThrowable(string $address, \Throwable $previous): self
    {
        $message = sprintf(self::MESSAGE_WHEN_THROWABLE, $address, $previous->getMessage());

        return new self($message, $previous->getCode(), $previous);
    }

    public static function whenAdd(string $message, string $address, ?\Throwable $previous = null): self
    {
        return new self(sprintf(self::MESSAGE_WHEN_ADD, $address, $message), previous: $previous);
    }

    public static function whenUpdate(string $message, string $address, ?\Throwable $previous = null): self
    {
        return new self(sprintf(self::MESSAGE_WHEN_UPDATE, $address, $message), previous: $previous);
    }

    public static function whenRemove(string $message, string $address, ?\Throwable $previous = null): self
    {
        return new self(sprintf(self::MESSAGE_WHEN_REMOVE, $address, $message), previous: $previous);
    }
}
