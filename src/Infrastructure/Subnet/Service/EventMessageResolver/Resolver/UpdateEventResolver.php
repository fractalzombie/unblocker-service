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

use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use UnBlockerService\Domain\Router\Service\Manager\ManagerInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Helper\SubnetHelper;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Resolver\EventResolverInterface;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\UpdateEventMessage;

#[Autoconfigure(lazy: EventResolverInterface::class), AutoconfigureTag(EventResolverInterface::class)]
final readonly class UpdateEventResolver implements EventResolverInterface
{
    public function __construct(
        private SubnetRepositoryInterface $repository,
        private ManagerInterface $routerManager,
    ) {}

    public function __invoke(UpdateEventMessage $message): void
    {
        if ($subnet = $this->repository->getOneById($message->id)) {
            if (SubnetHelper::equals($subnet->getSubnet(), SubnetHelper::makeSubnetFromEventMessage($message))) {
                $this->routerManager->updateSubnet($subnet);

                $subnet->setState(SubnetState::Added);
            }
        }
    }

    public function canResolve(EventMessage $message): bool
    {
        return $message instanceof UpdateEventMessage;
    }
}
