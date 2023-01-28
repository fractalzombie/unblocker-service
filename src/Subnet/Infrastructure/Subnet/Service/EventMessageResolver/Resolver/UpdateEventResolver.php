<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Subnet\Service\EventMessageResolver\Resolver;

use Doctrine\ORM\EntityManagerInterface;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use FRZB\Component\DependencyInjection\Attribute\AsTagged;
use UnBlockerService\Router\Domain\Service\Manipulator\ManagerInterface;
use UnBlockerService\Subnet\Domain\Entity\WriteOnlySubnetInterface;
use UnBlockerService\Subnet\Domain\Enum\SubnetState;
use UnBlockerService\Subnet\Domain\Helper\SubnetHelper;
use UnBlockerService\Subnet\Domain\Message\EventMessage;
use UnBlockerService\Subnet\Domain\Publisher\EventPublisherInterface;
use UnBlockerService\Subnet\Domain\Repository\SubnetRepositoryInterface;
use UnBlockerService\Subnet\Domain\Service\TransitionEventResolver\Resolver\EventResolverInterface;
use UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Message\UpdateEventMessage;

#[AsService, AsTagged(EventResolverInterface::class)]
final readonly class UpdateEventResolver implements EventResolverInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SubnetRepositoryInterface $repository,
        private ManagerInterface $routerManipulator,
    ) {
    }

    public function __invoke(UpdateEventMessage $message): void
    {
        if ($subnet = $this->repository->getOneById($message->id)) {
            if (SubnetHelper::equals($subnet->getSubnet(), SubnetHelper::makeSubnetFromEventMessage($message))) {
                $this->routerManipulator->updateSubnet($subnet);

                $this->entityManager->persist($subnet->setState(SubnetState::Added));
                $this->entityManager->flush();
            }
        }
    }

    public function canResolve(EventMessage $message): bool
    {
        return $message instanceof UpdateEventMessage
            && \in_array($message->state, SubnetState::cases())
        ;
    }
}
