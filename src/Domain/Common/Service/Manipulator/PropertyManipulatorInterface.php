<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Service\Manipulator;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Domain\Common\Service\Manipulator\Exception\ManipulatorException;
use UnBlockerService\Infrastructure\Common\Service\Manipulator\TargetManipulator;

#[AsAlias(TargetManipulator::class)]
interface PropertyManipulatorInterface
{
    /**
     * @return \ReflectionProperty[]
     *
     * @throws ManipulatorException
     */
    public function getPropertiesOf(string|object $target): array;
}
