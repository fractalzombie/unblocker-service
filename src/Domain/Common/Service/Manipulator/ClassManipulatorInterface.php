<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Service\Manipulator;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Domain\Common\Service\Manipulator\Exception\ManipulatorException;
use UnBlockerService\Infrastructure\Common\Service\Manipulator\TargetManipulator;

#[AsAlias(TargetManipulator::class)]
interface ClassManipulatorInterface
{
    /** @throws ManipulatorException */
    public function getShortName(string|object $target): string;

    /** @throws ManipulatorException */
    public function getReflectionOf(string|object $target): ?\ReflectionClass;

    /** @throws ManipulatorException */
    public function getParentReflectionOf(string|object $target): ?\ReflectionClass;
}
