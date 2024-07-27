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

namespace UnBlockerService\Infrastructure\Symfony\Serializer;

use FRZB\Component\DependencyInjection\Attribute\AsService;
use Symfony\Component\Security\Core\User\UserInterface as User;

#[AsService]
final class CircularReferenceHandler
{
    public function __invoke(object $object, string $format, array $context = []): string
    {
        return match (true) {
            $object instanceof User => $object->getUserIdentifier(),
            method_exists($object, 'getId') => $object->getId(),
            method_exists($object, 'getCorrelationId') => $object->getCorrelationId(),
            default => spl_object_hash($object),
        };
    }
}
