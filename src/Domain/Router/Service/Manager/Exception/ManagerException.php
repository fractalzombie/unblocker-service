<?php

declare(strict_types=1);

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 *
 * Copyright (c) 2024 Mykhailo Shtanko fractalzombie@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE.MD
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Domain\Router\Service\Manager\Exception;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Domain\Common\Trait\CreatesFromThrowableTrait;

#[Immutable]
final class ManagerException extends \LogicException
{
    use CreatesFromThrowableTrait;

    private const string MT_WHEN_THROWABLE = 'Exception for address %s: %s';
    private const string MT_WHEN_ADD = 'Failure to add %s address: %s';
    private const string MT_WHEN_UPDATE = 'Failure to update %s address: %s';
    private const string MT_WHEN_REMOVE = 'Failure to remove %s address: %s';

    public static function fromAddressAndThrowable(string $address, \Throwable $previous): self
    {
        $message = \sprintf(self::MT_WHEN_THROWABLE, $address, $previous->getMessage());

        return new self($message, $previous->getCode(), $previous);
    }

    public static function whenAdd(string $message, string $address, ?\Throwable $previous = null): self
    {
        return new self(\sprintf(self::MT_WHEN_ADD, $address, $message), previous: $previous);
    }

    public static function whenUpdate(string $message, string $address, ?\Throwable $previous = null): self
    {
        return new self(\sprintf(self::MT_WHEN_UPDATE, $address, $message), previous: $previous);
    }

    public static function whenRemove(string $message, string $address, ?\Throwable $previous = null): self
    {
        return new self(\sprintf(self::MT_WHEN_REMOVE, $address, $message), previous: $previous);
    }
}
