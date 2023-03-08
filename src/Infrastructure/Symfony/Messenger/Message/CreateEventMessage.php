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

namespace UnBlockerService\Infrastructure\Symfony\Messenger\Message;

use UnBlockerService\Domain\Subnet\Enum\EventType;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Service\Downloader\Serializer\ValueObject\Subnet;

final readonly class CreateEventMessage extends EventMessage
{
    public function __construct(
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

    public static function fromSubnet(Subnet $subnet, \DateTimeInterface $createdAt): self
    {
        return new self(
            $subnet->address,
            $subnet->mask,
            $subnet->country,
            $createdAt,
            $createdAt,
            SubnetState::New,
            EventType::Create,
        );
    }
}
