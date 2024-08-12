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

namespace UnBlockerService\Infrastructure\Common\Service\Manipulator;

use Fp\Collections\ArrayList;
use UnBlockerService\Domain\Common\Service\Manipulator\Exception\ManipulatorException;
use UnBlockerService\Domain\Common\Service\Manipulator\TargetManipulatorInterface;

class TargetManipulator implements TargetManipulatorInterface
{
    public const string DEFAULT_SHORT_CLASS_NAME = 'NoReflectionClass';

    public function getAttributesOf(object|string $target, string $attributeClass): array
    {
        return ArrayList::collect($this->getReflectionAttributesOf($target, $attributeClass))
            ->map(static fn (\ReflectionAttribute $attribute) => $attribute->newInstance())
            ->toList();
    }

    public function getInheritanceListOf(object|string $target): array
    {
        $isTargetObject = \is_object($target);
        $targetClass = $isTargetObject ? $target::class : $target;

        if (!class_exists($targetClass)) {
            throw ManipulatorException::notSupportedType($targetClass);
        }

        return [$targetClass => $targetClass, ...(class_parents($target, false) ?: [])];
    }

    /**
     * @psalm-template TTarget
     *
     * @psalm-param class-string<TTarget> $attributeClass
     *
     * @psalm-return \Iterator<\ReflectionAttribute<TTarget>>
     */
    public static function getReflectionAttributes(object|string $target, string $attributeClass): iterable
    {
        return self::getReflectionClass($target)
            ?->getAttributes($attributeClass, \ReflectionAttribute::IS_INSTANCEOF) ?? [];
    }

    /**
     * @psalm-template TTarget
     *
     * @psalm-param class-string<TTarget>|TTarget $target
     *
     * @psalm-return ?\ReflectionClass<TTarget>
     */
    public static function getReflectionClass(object|string $target): ?\ReflectionClass
    {
        try {
            return $target instanceof \ReflectionClass ? $target : new \ReflectionClass($target);
        } catch (\ReflectionException) {
            return null;
        }
    }

    /**
     * @psalm-template TTarget
     *
     * @psalm-param class-string<TTarget>|TTarget $target
     *
     * @psalm-return ?\ReflectionClass<TTarget>
     */
    public static function getParentReflectionClass(object|string $target): ?\ReflectionClass
    {
        return self::getReflectionClass($target)?->getParentClass() ?: null;
    }

    public function getReflectionAttributesOf(object|string $target, string $attributeClass): array
    {
        try {
            return ArrayList::collect($this->getInheritanceListOf($target))
                ->map(static fn (string $class) => new \ReflectionClass($class))
                ->map(fn (\ReflectionClass $rClass) => $this->getReflectionAttributes($rClass, $attributeClass))
                ->reverse()
                ->flatten()
                ->toList();
        } catch (\Throwable $e) {
            throw ManipulatorException::fromThrowable($e);
        }
    }

    public function getPropertiesOf(object|string $target): array
    {
        return ArrayList::collect($this->getInheritanceListOf($target))
            ->map(static fn (string $class) => new \ReflectionClass($class))
            ->map(static fn (\ReflectionClass $rClass) => $rClass->getProperties())
            ->flatten()
            ->uniqueBy(static fn (\ReflectionProperty $rProperty) => $rProperty->getName())
            ->reverse()
            ->toList();
    }

    public function getShortName(object|string $target): string
    {
        return $this->getReflectionOf($target)?->getShortName() ?: self::DEFAULT_SHORT_CLASS_NAME;
    }

    public function getReflectionOf(object|string $target): ?\ReflectionClass
    {
        try {
            return match (true) {
                $target instanceof \ReflectionClass => $target,
                \is_object($target) => new \ReflectionClass($target),
                \is_string($target) && class_exists($target) => new \ReflectionClass($target),
                default => throw ManipulatorException::notSupportedType(\gettype($target)),
            };
        } catch (\Throwable $e) {
            throw ManipulatorException::fromThrowable($e);
        }
    }

    public function getParentReflectionOf(object|string $target): ?\ReflectionClass
    {
        return match (true) {
            $target instanceof \ReflectionClass => $target->getParentClass() ?: null,
            'string' === \gettype($target) && class_exists($target) => $this->getReflectionOf($target)->getParentClass() ?: null,
            default => throw ManipulatorException::notSupportedType(\gettype($target)),
        };
    }
}
