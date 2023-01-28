<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Subnet\Service\EventMessageResolver\Resolver;

use Doctrine\ORM\EntityManagerInterface;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use FRZB\Component\DependencyInjection\Attribute\AsTagged;
use UnBlockerService\Router\Domain\Service\Manipulator\ManagerInterface;
use UnBlockerService\Subnet\Domain\Enum\SubnetState;
use UnBlockerService\Subnet\Domain\Message\EventMessage;
use UnBlockerService\Subnet\Domain\Repository\SubnetRepositoryInterface;
use UnBlockerService\Subnet\Domain\Service\TransitionEventResolver\Resolver\EventResolverInterface;
use UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Message\AddEventMessage;

#[AsService, AsTagged(EventResolverInterface::class)]
final readonly class AddEventResolver implements EventResolverInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SubnetRepositoryInterface $repository,
        private ManagerInterface $routerManipulator,
    ) {
    }

    public function __invoke(AddEventMessage $message): void
    {
        if ($subnet = $this->repository->getOneById($message->id)) {
            $subnet->setExternalId($this->routerManipulator->addSubnet($subnet)->getId());

            $this->entityManager->persist($subnet);
            $this->entityManager->flush();
        }
    }

    public function canResolve(EventMessage $message): bool
    {
        return $message instanceof AddEventMessage
            && \in_array($message->state, [SubnetState::Created, SubnetState::Updated])
        ;
    }
}
