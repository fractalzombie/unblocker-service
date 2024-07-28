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

use Fp\Collections\ArrayList;
use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Infrastructure\Doctrine\Trait\PrivateConstructorTrait;

#[Immutable]
final readonly class AttributeHelper
{
    use PrivateConstructorTrait;

    public static function hasAttribute(object|string $target, string $attributeClass): bool
    {
        return !empty(self::getReflectionAttributes($target, $attributeClass));
    }

    /**
     * @psalm-template TAttribute
     *
     * @psalm-param class-string<TAttribute>|string $attributeClass
     *
     * @psalm-return ?TAttribute
     */
    public static function getAttribute(object|string $target, string $attributeClass): ?object
    {
        return ArrayList::collect(self::getAttributes($target, $attributeClass))
            ->firstElement()
            ->get();
    }

    /**
     * @psalm-template TAttribute
     *
     * @psalm-param class-string<TAttribute> $attributeClass
     *
     * @psalm-return TAttribute[]
     */
    public static function getAttributes(object|string $target, string $attributeClass): array
    {
        return ArrayList::collect(self::getReflectionAttributes($target, $attributeClass))
            ->map(static fn (\ReflectionAttribute $a) => $a->newInstance())
            ->toList();
    }

    /**
     * @psalm-template TAttribute
     *
     * @psalm-param class-string<TAttribute> $attributeClass
     *
     * @psalm-return \ReflectionAttribute<TAttribute>[]
     */
    public static function getReflectionAttributes(object|string $target, string $attributeClass): array
    {
        return ArrayList::collect(ClassHelper::getInheritanceList($target))
            ->map(static fn (string $class) => new \ReflectionClass($class))
            ->map(static fn (\ReflectionClass $rClass) => ClassHelper::getReflectionAttributes($rClass, $attributeClass))
            ->toMergedArray();
    }
}
