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

use Doctrine\ORM\EntityManagerInterface;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use FRZB\Component\DependencyInjection\Attribute\AsTagged;
use UnBlockerService\Domain\Router\Service\Manager\ManagerInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Resolver\EventResolverInterface;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\AddEventMessage;

#[AsService, AsTagged(EventResolverInterface::class)]
final readonly class AddEventResolver implements EventResolverInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SubnetRepositoryInterface $repository,
        private ManagerInterface $routerManager,
    ) {
    }

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
            && \in_array($message->state, [SubnetState::Created, SubnetState::Updated])
        ;
    }
}
