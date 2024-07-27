<?php

declare(strict_types=1);

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 *
 * Copyright (c) 2024 Mykhailo Shtanko fractalzombie@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE.MD
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Infrastructure\Doctrine\Entity;

use ApiPlatform\Metadata as API;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Uid\Uuid;
use UnBlockerService\Domain\Subnet\Entity\SubnetInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Helper\SubnetHelper;
use UnBlockerService\Domain\Subnet\Processor\PostSubnetProcessor;
use UnBlockerService\Domain\Subnet\Provider\SubnetDataProvider;
use UnBlockerService\Domain\Subnet\Request\PostSubnetRequest;
use UnBlockerService\Domain\Subnet\Response\GetSubnetResponse;
use UnBlockerService\Domain\Subnet\Response\PostSubnetResponse;
use UnBlockerService\Infrastructure\Doctrine\Repository\SubnetRepository;
use UnBlockerService\Infrastructure\Doctrine\Trait\HasCountry;
use UnBlockerService\Infrastructure\Doctrine\Trait\HasCreatedAt;
use UnBlockerService\Infrastructure\Doctrine\Trait\HasIdentifier;
use UnBlockerService\Infrastructure\Doctrine\Trait\HasUpdatedAt;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\CreateEventMessage;

#[API\ApiResource(
    operations: [
        new API\GetCollection(
            output: GetSubnetResponse::class,
            provider: SubnetDataProvider::class,
        ),
        new API\Get(
            output: GetSubnetResponse::class,
            provider: SubnetDataProvider::class,
        ),
        new API\Post(
            input: PostSubnetRequest::class,
            output: PostSubnetResponse::class,
            processor: PostSubnetProcessor::class,
        ),
    ],
)]
#[ORM\UniqueConstraint(fields: ['address', 'mask'])]
#[ORM\Entity(repositoryClass: SubnetRepository::class)]
final class Subnet implements SubnetInterface
{
    use HasCountry;
    use HasCreatedAt;
    use HasIdentifier;
    use HasUpdatedAt;

    private const int MAX_LENGTH_EXTERNAL_ID = 32;
    private const int MAX_LENGTH_OF_ADDRESS = 15;
    private const int MAX_LENGTH_OF_MASK = 2;
    private const int MAX_LENGTH_OF_STATE = 16;

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
        $this->id = Uuid::v4();
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
