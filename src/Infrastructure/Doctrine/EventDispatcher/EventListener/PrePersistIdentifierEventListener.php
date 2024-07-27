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

namespace UnBlockerService\Infrastructure\Doctrine\EventDispatcher\EventListener;

use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Bridge\Doctrine\IdGenerator\UuidGenerator;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Uid\Uuid;
use UnBlockerService\Domain\Common\Entity\IdentifierInterface;
use UnBlockerService\Infrastructure\Doctrine\Entity\Subnet;

#[AsEntityListener(Events::prePersist, entity: Subnet::class)]
final readonly class PrePersistIdentifierEventListener
{
    public function __construct(
        #[Autowire(service: 'doctrine.uuid_generator')]
        private UuidGenerator $uuidGenerator,
        private EntityManagerInterface $entityManager,
    ) {}

    public function __invoke(IdentifierInterface $target, PrePersistEventArgs $event): void
    {
        if (!$target->hasIdentifier()) {
            $this->uuidGenerator->generateId($this->entityManager, $target);
        }
    }
}
