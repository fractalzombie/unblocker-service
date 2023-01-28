<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Message;

use FRZB\Component\TransactionalMessenger\Attribute\Transactional;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;
use UnBlockerService\Subnet\Domain\Enum\EventType;
use UnBlockerService\Subnet\Domain\Enum\SubnetState;
use UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Message\AddEventMessage;
use UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Message\CreateEventMessage;
use UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Message\UpdateEventMessage;

#[Transactional]
#[DiscriminatorMap(self::TYPE_PROPERTY, self::DISCRIMINATOR_MAP)]
readonly abstract class EventMessage
{
    final public const TYPE_PROPERTY = 'eventType';

    final public const DISCRIMINATOR_MAP = [
        EventType::CREATE => CreateEventMessage::class,
        EventType::UPDATE => UpdateEventMessage::class,
        EventType::ADD => AddEventMessage::class,
    ];

    public function __construct(
        public string $address,
        public int $mask,
        public string $country,
        public \DateTimeInterface $createdAt,
        public \DateTimeInterface $updatedAt,
        public SubnetState $state,
        public EventType $eventType,
    ) {
    }
}
