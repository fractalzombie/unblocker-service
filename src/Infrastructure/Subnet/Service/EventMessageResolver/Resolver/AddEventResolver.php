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

namespace UnBlockerService\Infrastructure\Subnet\Service\EventMessageResolver\Resolver;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use UnBlockerService\Domain\Router\Service\Manager\ManagerInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Resolver\EventResolverInterface;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\AddEventMessage;

#[Autoconfigure(lazy: EventResolverInterface::class), AutoconfigureTag(EventResolverInterface::class)]
final readonly class AddEventResolver implements EventResolverInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SubnetRepositoryInterface $repository,
        private ManagerInterface $routerManager,
    ) {}

    public function __invoke(AddEventMessage $message): void
    {
        if ($subnet = $this->repository->getOneById($message->id)) {
            $subnet->setExternalId($this->routerManager->addSubnet($subnet)->getId());

            $this->entityManager->persist($subnet);
        }
    }

    public function canResolve(EventMessage $message): bool
    {
        return $message instanceof AddEventMessage
            && \in_array($message->state, [SubnetState::Created, SubnetState::Updated]);
    }
}
