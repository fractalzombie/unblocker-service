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

namespace UnBlockerService\Infrastructure\Subnet\Provider\Exception;

use ApiPlatform\Metadata\Operation;
use UnBlockerService\Domain\Common\Trait\CreatesFromThrowableTrait;

final class SubnetDataProviderException extends \LogicException
{
    use CreatesFromThrowableTrait;

    final public const string MT_NOT_SUPPORTED_PROVIDER = 'Provider %s not supported';

    public static function notSupportedOperation(Operation $operation): self
    {
        return new self(\sprintf(self::MT_NOT_SUPPORTED_PROVIDER, $operation::class));
    }
}
