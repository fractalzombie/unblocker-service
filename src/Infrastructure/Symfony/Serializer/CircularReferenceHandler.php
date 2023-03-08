<?php

declare(strict_types=1);

/*
 * UnBlocker service for routers.
 *
 * (c) Mykhailo Shtanko <fractalzombie@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
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
