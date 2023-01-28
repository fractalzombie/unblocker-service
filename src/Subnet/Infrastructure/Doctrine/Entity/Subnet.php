<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Doctrine\Entity;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use UnBlockerService\Common\Infrastructure\Doctrine\Trait\HasCountry;
use UnBlockerService\Common\Infrastructure\Doctrine\Trait\HasCreatedAt;
use UnBlockerService\Common\Infrastructure\Doctrine\Trait\HasIdentifier;
use UnBlockerService\Common\Infrastructure\Doctrine\Trait\HasUpdatedAt;
use UnBlockerService\Subnet\Domain\Entity\SubnetInterface;
use UnBlockerService\Subnet\Domain\Enum\SubnetState;
use UnBlockerService\Subnet\Domain\Helper\SubnetHelper;
use UnBlockerService\Subnet\Infrastructure\Doctrine\Repository\SubnetRepository;
use UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Message\CreateEventMessage;

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

    public static function fromCreateEventMessage(CreateEventMessage $message): self
    {
        return new self(
            $message->address,
            $message->mask,
            $message->country,
            $message->createdAt,
            $message->updatedAt,
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
