<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Symfony\Messenger\Message;

use Symfony\Component\Uid\Uuid;
use UnBlockerService\Domain\Subnet\Enum\EventType;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Infrastructure\Doctrine\Entity\Subnet;

final readonly class UpdateEventMessage extends EventMessage
{
    public function __construct(
        public Uuid $id,
        public ?string $externalId,
        public string $address,
        public int $mask,
        public string $country,
        public \DateTimeInterface $createdAt,
        public \DateTimeInterface $updatedAt,
        public SubnetState $state,
        EventType $eventType,
    ) {
        parent::__construct($eventType);
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
