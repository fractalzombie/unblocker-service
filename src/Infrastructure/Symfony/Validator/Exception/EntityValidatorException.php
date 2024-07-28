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

namespace UnBlockerService\Infrastructure\Symfony\Validator\Exception;

class EntityValidatorException extends \LogicException
{
    private const string MT_CLASS_IS_NOT_ENTITY = 'Class "%s" has no Doctrine\ORM\Mapping\Entity attribute';

    public static function notEntityClass(string $class, ?\Throwable $previous = null): self
    {
        $message = \sprintf(self::MT_CLASS_IS_NOT_ENTITY, $class);

        return new self($message, previous: $previous);
    }
}
