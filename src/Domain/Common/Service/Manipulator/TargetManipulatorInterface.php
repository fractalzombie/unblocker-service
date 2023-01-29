<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Service\Manipulator;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Infrastructure\Common\Service\Manipulator\TargetManipulator;

#[AsAlias(TargetManipulator::class)]
interface TargetManipulatorInterface extends AttributeManipulatorInterface, ClassManipulatorInterface, PropertyManipulatorInterface
{
}
