<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Infrastructure\Symfony\Serializer;

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
