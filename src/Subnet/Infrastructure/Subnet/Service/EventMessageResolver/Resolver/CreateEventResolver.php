<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Subnet\Service\EventMessageResolver\Resolver;

use Doctrine\ORM\EntityManagerInterface;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use FRZB\Component\DependencyInjection\Attribute\AsTagged;
use UnBlockerService\Subnet\Domain\Enum\SubnetState;
use UnBlockerService\Subnet\Domain\Message\EventMessage;
use UnBlockerService\Subnet\Domain\Publisher\EventPublisherInterface;
use UnBlockerService\Subnet\Domain\Repository\SubnetRepositoryInterface;
use UnBlockerService\Subnet\Domain\Service\TransitionEventResolver\Exception\EventResolverException;
use UnBlockerService\Subnet\Domain\Service\TransitionEventResolver\Resolver\EventResolverInterface;
use UnBlockerService\Subnet\Infrastructure\Doctrine\Entity\Subnet;
use UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Message\CreateEventMessage;
use UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Message\UpdateEventMessage;

#[AsService, AsTagged(EventResolverInterface::class)]
final readonly class CreateEventResolver implements EventResolverInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
        private SubnetRepositoryInterface $repository,
        private EventPublisherInterface $publisher,
    ) {
    }

    public function __invoke(CreateEventMessage $message): void
    {
        try {
            $this->repository->isExistByAddressAndMask($message->address, $message->mask)
                ? $this->isSubnetExists($message)
                : $this->isSubnetNotExists($message)
            ;
        } catch (\Throwable $e) {
            throw EventResolverException::fromThrowable($e);
        }
    }

    public function canResolve(EventMessage $message): bool
    {
        return $message instanceof CreateEventMessage
            && \in_array($message->state, [SubnetState::New, SubnetState::Updated])
        ;
    }

    private function isSubnetExists(CreateEventMessage $message): void
    {
        $subnet = $this->repository->getOneByAddressAndMask($message->address, $message->mask);

        $this->publisher->publish(UpdateEventMessage::fromSubnet($subnet));
    }
    private function isSubnetNotExists(CreateEventMessage $message): void
    {
        $this->entityManager->persist(Subnet::fromCreateEventMessage($message));
        $this->entityManager->flush();
    }
}
