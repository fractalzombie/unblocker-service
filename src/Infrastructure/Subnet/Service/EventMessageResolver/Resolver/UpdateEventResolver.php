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

namespace UnBlockerService\Infrastructure\Subnet\Service\EventMessageResolver\Resolver;

use FRZB\Component\DependencyInjection\Attribute\AsService;
use FRZB\Component\DependencyInjection\Attribute\AsTagged;
use UnBlockerService\Domain\Router\Service\Manager\ManagerInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Helper\SubnetHelper;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Resolver\EventResolverInterface;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\UpdateEventMessage;

#[AsService, AsTagged(EventResolverInterface::class)]
final readonly class UpdateEventResolver implements EventResolverInterface
{
    public function __construct(
        private SubnetRepositoryInterface $repository,
        private ManagerInterface $routerManager,
    ) {
    }

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
