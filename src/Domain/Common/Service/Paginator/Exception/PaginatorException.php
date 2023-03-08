<?php

declare(strict_types=1);

/*
 * UnBlocker service for routers.
 *
 * (c) Mykhailo Shtanko <fractalzombie@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Domain\Common\Service\Paginator\Exception;

use UnBlockerService\Domain\Common\Trait\CreatesFromThrowableTrait;

final class PaginatorException extends \InvalidArgumentException
{
    use CreatesFromThrowableTrait;

    private const MESSAGE_CAN_NOT_BE_NULL = 'Use builder method %s to set %s property, it can not be null';

    public static function isNull(string $propertyName, ?string $methodName = null, ?\Throwable $previous = null): self
    {
        $message = sprintf(self::MESSAGE_CAN_NOT_BE_NULL, $methodName ?? $propertyName, $propertyName);

        return new self($message, (int) $previous?->getCode(), previous: $previous);
    }
}
