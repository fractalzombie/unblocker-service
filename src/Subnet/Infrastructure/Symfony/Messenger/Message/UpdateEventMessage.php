<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Message;

use Symfony\Component\Uid\Uuid;
use UnBlockerService\Subnet\Domain\Enum\EventType;
use UnBlockerService\Subnet\Domain\Enum\SubnetState;
use UnBlockerService\Subnet\Domain\Message\EventMessage;
use UnBlockerService\Subnet\Infrastructure\Doctrine\Entity\Subnet;

final readonly class UpdateEventMessage extends EventMessage
{
    public function __construct(
        public Uuid $id,
        public string $externalId,
        string $address,
        int $mask,
        string $country,
        \DateTimeInterface $createdAt,
        \DateTimeInterface $updatedAt,
        SubnetState $state,
        EventType $eventType
    ) {
        parent::__construct($address, $mask, $country, $createdAt, $updatedAt, $state, $eventType);
    }

    public static function fromSubnet(Subnet $subnet): self
    {
        return new self(
            $subnet->getId(),
            $subnet->getExternalId(),
            $subnet->getAddress(),
            $subnet->getMask(),
            $subnet->getCountry(),
            $subnet->getCreatedAt(),
            $subnet->getUpdatedAt(),
            $subnet->getState(),
            EventType::Update,
        );
    }
}
