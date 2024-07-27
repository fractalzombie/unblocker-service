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

use UnBlockerService\Domain\Common\Service\Manipulator\Exception\ManipulatorException;

interface AttributeManipulatorInterface
{
    /**
     * @psalm-template TAttribute
     *
     * @psalm-param class-string<TAttribute>|string $attributeClass
     *
     * @psalm-return TAttribute[]
     *
     * @throws ManipulatorException
     */
    public function getAttributesOf(object|string $target, string $attributeClass): array;

    /**
     * @psalm-template TAttribute
     *
     * @psalm-param class-string<TAttribute> $attributeClass
     *
     * @psalm-return \ReflectionAttribute<TAttribute>[]
     */
    public function getReflectionAttributes(object|string $target, string $attributeClass): array;
}
