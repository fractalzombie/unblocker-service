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
    public function getPropertiesOf(object|string $target): array;
}
