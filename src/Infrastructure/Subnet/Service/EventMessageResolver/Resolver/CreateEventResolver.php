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
use Psr\Clock\ClockInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Publisher\EventPublisherInterface;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Exception\EventResolverException;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Resolver\EventResolverInterface;
use UnBlockerService\Infrastructure\Doctrine\Entity\Subnet;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\CreateEventMessage;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\UpdateEventMessage;

#[AutoconfigureTag(EventResolverInterface::class)]
final readonly class CreateEventResolver implements EventResolverInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SubnetRepositoryInterface $repository,
        private EventPublisherInterface $publisher,
        private ClockInterface $clock,
    ) {}

    public function __invoke(CreateEventMessage $message): void
    {
        try {
            $this->repository->isExistByAddressAndMask($message->address, $message->mask)
                ? $this->isSubnetExists($message)
                : $this->isSubnetNotExists($message);
        } catch (\Throwable $e) {
            throw EventResolverException::fromThrowable($e);
        }
    }

    public function canResolve(EventMessage $message): bool
    {
        return $message instanceof CreateEventMessage
            && \in_array($message->state, [SubnetState::New, SubnetState::Updated]);
    }

    private function isSubnetExists(CreateEventMessage $message): void
    {
        $subnet = $this->repository->getOneByAddressAndMask($message->address, $message->mask);

        $this->publisher->publish(UpdateEventMessage::fromSubnet($subnet));
    }

    private function isSubnetNotExists(CreateEventMessage $message): void
    {
        $this->entityManager->persist(Subnet::fromCreateEventMessage($message));
    }
}
