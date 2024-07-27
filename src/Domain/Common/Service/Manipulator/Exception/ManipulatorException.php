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

namespace UnBlockerService\Domain\Common\Service\Manipulator\Exception;

use UnBlockerService\Domain\Common\Trait\CreatesFromThrowableTrait;

final class ManipulatorException extends \LogicException
{
    use CreatesFromThrowableTrait;

    private const MESSAGE_WHEN_NOT_SUPPORTED_TYPE = 'Type %s is not supported';

    public static function notSupportedType(string $typeName): self
    {
        return new self(\sprintf(self::MESSAGE_WHEN_NOT_SUPPORTED_TYPE, $typeName));
    }
}
