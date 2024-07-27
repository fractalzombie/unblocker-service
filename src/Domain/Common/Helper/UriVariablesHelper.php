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

namespace UnBlockerService\Domain\Common\Helper;

use JetBrains\PhpStorm\Immutable;
use Symfony\Component\Uid\Uuid;
use UnBlockerService\Infrastructure\Doctrine\Trait\PrivateConstructorTrait;

#[Immutable]
final readonly class UriVariablesHelper
{
    use PrivateConstructorTrait;

    private const string DEFAULT_URI_ID_PARAMETER = 'id';

    public static function getUuid(array $variables): Uuid
    {
        $id = $variables[self::DEFAULT_URI_ID_PARAMETER] ?? throw new \InvalidArgumentException();

        if ($id instanceof Uuid) {
            return $id;
        }

        return Uuid::isValid($id) ? Uuid::fromString($id) : throw new \InvalidArgumentException();
    }

    public static function getUuidRfc4122(array $variables): string
    {
        return self::getUuid($variables)->toRfc4122();
    }
}
