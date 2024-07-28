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

namespace UnBlockerService\Resource;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata as Rest;
use ApiPlatform\OpenApi\Model as OARest;
use Doctrine\Common\Collections\Order;
use Symfony\Component\Serializer\Attribute as Serializer;
use Symfony\Component\Uid\Uuid;
use Symfony\Component\Validator\Constraints as Assert;
use UnBlockerService\Domain\Subnet\Entity\SubnetInterface;
use UnBlockerService\Domain\Subnet\Enum\ContextGroup;
use UnBlockerService\Infrastructure\Doctrine\Entity\Subnet;
use UnBlockerService\Infrastructure\Subnet\Processor\SubnetResourceProcessor;
use UnBlockerService\Infrastructure\Subnet\Provider\SubnetResourceProvider;

#[Rest\ApiResource(
    shortName: self::SHORT_NAME,
    operations: [
        new Rest\GetCollection(
            uriTemplate: '/subnets',
            provider: SubnetResourceProvider::class,
        ),
        new Rest\Get(
            uriTemplate: '/subnets/{id}',
            provider: SubnetResourceProvider::class
        ),
        new Rest\Post(
            uriTemplate: '/subnets',
            processor: SubnetResourceProcessor::class
        ),
        new Rest\Patch(
            uriTemplate: '/subnets/{id}',
            processor: SubnetResourceProcessor::class
        ),
        new Rest\Put(
            uriTemplate: '/subnets/{id}',
            processor: SubnetResourceProcessor::class
        ),
        new Rest\Delete(
            uriTemplate: '/subnets/{id}',
            processor: SubnetResourceProcessor::class
        ),
    ],
    class: Subnet::class,
    openapi: new OARest\Operation(tags: [self::SHORT_NAME]),
    order: ['createdAt' => Order::Descending->value],
    stateOptions: new Options(Subnet::class),
)]
final readonly class SubnetResource
{
    private const string SHORT_NAME = 'Subnets';

    #[Rest\ApiProperty(writable: false, required: false, identifier: true, example: '15eeb220-de9a-4541-bede-ce20e4a8da2e')]
    #[Serializer\Groups([ContextGroup::SUBNET_READ])]
    public ?Uuid $id;

    #[Rest\ApiProperty(writable: true, required: true, example: '10.10.10.0')]
    #[Serializer\Groups([ContextGroup::SUBNET_READ, ContextGroup::SUBNET_WRITE, ContextGroup::SUBNET_PATCH, ContextGroup::SUBNET_PUT])]
    #[Assert\Ip(version: Assert\Ip::V4), Assert\NotBlank]
    public ?string $address;

    #[Rest\ApiProperty(writable: true, required: true, example: 24)]
    #[Serializer\Groups([ContextGroup::SUBNET_READ, ContextGroup::SUBNET_WRITE, ContextGroup::SUBNET_PATCH, ContextGroup::SUBNET_PUT])]
    #[Assert\GreaterThan(value: 16), Assert\LessThanOrEqual(value: 31), Assert\NotBlank]
    public ?int $mask;

    #[Rest\ApiProperty(writable: true, required: true, example: 'UA')]
    #[Serializer\Groups([ContextGroup::SUBNET_READ, ContextGroup::SUBNET_WRITE, ContextGroup::SUBNET_PATCH, ContextGroup::SUBNET_PUT])]
    #[Assert\Country, Assert\NotBlank]
    public ?string $country;

    #[Rest\ApiProperty(readable: true, writable: false, required: false, example: '2024-08-02T22:18:55.000+00:00')]
    #[Serializer\Groups([ContextGroup::SUBNET_READ])]
    public ?\DateTimeInterface $createdAt;

    #[Rest\ApiProperty(readable: true, writable: false, required: false, example: '2024-08-02T22:18:55.000+00:00')]
    #[Serializer\Groups([ContextGroup::SUBNET_READ])]
    public ?\DateTimeInterface $updatedAt;

    public function __construct(
        ?Uuid $id = null,
        ?string $address = null,
        ?int $mask = null,
        ?string $country = null,
        ?\DateTimeInterface $createdAt = null,
        ?\DateTimeInterface $updatedAt = null,
    ) {
        $this->id = $id;
        $this->address = $address;
        $this->mask = $mask;
        $this->country = $country;
        $this->createdAt = $createdAt;
        $this->updatedAt = $updatedAt;
    }

    public static function fromSubnetEntity(SubnetInterface $subnet): self
    {
        return new self(
            $subnet->getId(),
            $subnet->getAddress(),
            $subnet->getMask(),
            $subnet->getCountry(),
            $subnet->getCreatedAt(),
            $subnet->getUpdatedAt(),
        );
    }
}
