<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Message;

use UnBlockerService\Subnet\Domain\Enum\EventType;
use UnBlockerService\Subnet\Domain\Enum\SubnetState;
use UnBlockerService\Subnet\Domain\Message\EventMessage;
use UnBlockerService\Subnet\Domain\Service\Downloader\Serializer\ValueObject\Subnet;

final readonly class CreateEventMessage extends EventMessage
{
    public static function fromSubnet(Subnet $subnet): self
    {
        return new self(
            $subnet->address,
            $subnet->mask,
            $subnet->country,
            new \DateTimeImmutable(),
            new \DateTimeImmutable(),
            SubnetState::New,
            EventType::Create,
        );
    }
}
