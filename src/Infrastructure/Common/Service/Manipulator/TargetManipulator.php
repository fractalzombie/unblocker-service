<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Common\Service\Manipulator;

use Fp\Collections\ArrayList;
use Fp\Functional\Option\Option;
use Illuminate\Support\Arr;
use UnBlockerService\Domain\Common\Service\Manipulator\Exception\ManipulatorException;
use UnBlockerService\Domain\Common\Service\Manipulator\TargetManipulatorInterface;

class TargetManipulator implements TargetManipulatorInterface
{
    public const DEFAULT_SHORT_CLASS_NAME = 'NoReflectionClass';

    /** {@inheritdoc} */
    public function getAttributesOf(object|string $target, string $attributeClass): array
    {
        return ArrayList::collect($this->getReflectionAttributes($target, $attributeClass))
            ->map(static fn (\ReflectionAttribute $attribute) => $attribute->newInstance())
            ->toArray()
        ;
    }

    /** {@inheritdoc} */
    public function getReflectionAttributes(string|object $target, string $attributeClass): array
    {
        try {
            $attributes = Option::fromNullable($this->getReflectionOf($target))
                ->map(fn (\ReflectionClass $trClass) => [
                    ...$trClass->getAttributes($attributeClass, \ReflectionAttribute::IS_INSTANCEOF),
                    ...Option::fromNullable($this->getParentReflectionOf($target))
                        ->map(fn (\ReflectionClass $tprClass) => $this->getReflectionAttributes($tprClass, $attributeClass))
                        ->getOrElse([]),
                ])->getOrElse([])
            ;
        } catch (\Throwable $e) {
            throw ManipulatorException::fromThrowable($e);
        }

        return ArrayList::collect($attributes)
            ->unique(fn (\ReflectionAttribute $ra) => Arr::join($ra->getArguments(), ';'))
            ->sorted(fn (\ReflectionAttribute $ral, \ReflectionAttribute $rar) => Arr::join($rar->getArguments(), ';') <=> Arr::join($ral->getArguments(), ';'))
            ->reverse()
            ->toArray()
        ;
    }

    /** {@inheritdoc} */
    public function getPropertiesOf(object|string $target): array
    {
        $properties = Option::fromNullable($this->getReflectionOf($target))
            ->map(fn (\ReflectionClass $trClass) => [
                ...$trClass->getProperties(),
                ...Option::fromNullable($this->getParentReflectionOf($target))
                    ->map(fn (\ReflectionClass $tprClass) => $this->getPropertiesOf($tprClass->getName()))
                    ->getOrElse([]),
            ])->getOrElse([]);

        return ArrayList::collect($properties)
            ->unique(fn (\ReflectionProperty $rp) => $rp->getName())
            ->reverse()
            ->toArray()
        ;
    }

    /** {@inheritdoc} */
    public function getShortName(object|string $target): string
    {
        return $this->getReflectionOf($target)?->getShortName() ?: self::DEFAULT_SHORT_CLASS_NAME;
    }

    /** {@inheritdoc} */
    public function getReflectionOf(string|object $target): ?\ReflectionClass
    {
        try {
            return match (true) {
                $target instanceof \ReflectionClass => $target,
                'string' === \gettype($target) && class_exists($target) => new \ReflectionClass($target),
                default => throw ManipulatorException::notSupportedType(\gettype($target)),
            };
        } catch (\Throwable $e) {
            throw ManipulatorException::fromThrowable($e);
        }
    }

    /** {@inheritdoc} */
    public function getParentReflectionOf(object|string $target): ?\ReflectionClass
    {
        return match (true) {
            $target instanceof \ReflectionClass => $target->getParentClass() ?: null,
            'string' === \gettype($target) && class_exists($target) => $this->getReflectionOf($target)->getParentClass() ?: null,
            default => throw ManipulatorException::notSupportedType(\gettype($target)),
        };
    }
}
