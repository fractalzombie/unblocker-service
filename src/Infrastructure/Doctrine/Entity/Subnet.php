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

namespace UnBlockerService\Infrastructure\Doctrine\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use UnBlockerService\Domain\Subnet\Entity\SubnetInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Helper\SubnetHelper;
use UnBlockerService\Infrastructure\Doctrine\Trait\HasCountry;
use UnBlockerService\Infrastructure\Doctrine\Trait\HasCreatedAt;
use UnBlockerService\Infrastructure\Doctrine\Trait\HasIdentifier;
use UnBlockerService\Infrastructure\Doctrine\Trait\HasUpdatedAt;
use UnBlockerService\Infrastructure\Subnet\Repository\SubnetRepository;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\CreateEventMessage;

#[ORM\UniqueConstraint(fields: ['address', 'mask'])]
#[ORM\Entity(repositoryClass: SubnetRepository::class)]
final class Subnet implements SubnetInterface
{
    use HasCountry;
    use HasCreatedAt;
    use HasIdentifier;
    use HasUpdatedAt;

    private const MAX_LENGTH_EXTERNAL_ID = 32;
    private const MAX_LENGTH_OF_ADDRESS = 15;
    private const MAX_LENGTH_OF_MASK = 2;
    private const MAX_LENGTH_OF_STATE = 16;

    #[ORM\Column(type: Types::STRING, length: self::MAX_LENGTH_EXTERNAL_ID, unique: true, nullable: true)]
    private ?string $externalId;

    #[ORM\Column(type: Types::STRING, length: self::MAX_LENGTH_OF_ADDRESS)]
    private string $address;

    #[ORM\Column(type: Types::SMALLINT, length: self::MAX_LENGTH_OF_MASK)]
    private int $mask;

    #[ORM\Column(type: Types::STRING, length: self::MAX_LENGTH_OF_STATE, enumType: SubnetState::class)]
    private SubnetState $state;

    public function __construct(
        string $address,
        int $mask,
        string $country,
        \DateTimeInterface $createdAt,
        \DateTimeInterface $updatedAt,
        SubnetState $state = SubnetState::New,
    ) {
        $this->address = $address;
        $this->externalId = null;
        $this->mask = $mask;
        $this->country = $country;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
        $this->state = $state;
    }

    public static function fromCreateEventMessage(CreateEventMessage $message, \DateTimeInterface $createdAt): self
    {
        return new self(
            $message->address,
            $message->mask,
            $message->country,
            $createdAt,
            $createdAt,
            SubnetState::Created,
        );
    }

    public function getExternalId(): ?string
    {
        return $this->externalId;
    }

    public function setExternalId(string $externalId): self
    {
        $this->externalId = $externalId;

        return $this;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function setAddress(string $address): self
    {
        $this->address = $address;

        return $this;
    }

    public function getMask(): int
    {
        return $this->mask;
    }

    public function setMask(int $mask): self
    {
        $this->mask = $mask;

        return $this;
    }

    public function getState(): SubnetState
    {
        return $this->state;
    }

    public function setState(SubnetState $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getSubnet(): string
    {
        return SubnetHelper::makeSubnets($this->address, $this->mask);
    }

    public function getGroupName(): string
    {
        return "BLACKLIST_{$this->country}";
    }
}
