<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Service\Manipulator;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Domain\Common\Service\Manipulator\Exception\ManipulatorException;
use UnBlockerService\Infrastructure\Common\Service\Manipulator\TargetManipulator;

#[AsAlias(TargetManipulator::class)]
interface AttributeManipulatorInterface
{
    /**
     * @template T
     *
     * @param class-string<T> $attributeClass
     *
     * @return T[]
     *
     * @throws ManipulatorException
     */
    public function getAttributesOf(string|object $target, string $attributeClass): array;

    /**
     * @template T
     *
     * @param class-string<T> $attributeClass
     *
     * @return \ReflectionAttribute<T>[]
     */
    public function getReflectionAttributes(string|object $target, string $attributeClass): array;
}
