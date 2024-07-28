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

namespace UnBlockerService\Infrastructure\Request;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use Doctrine\DBAL\Types\DateTimeType;
use JetBrains\PhpStorm\Immutable;
use Symfony\Component\Validator\Constraints as Assert;
use UnBlockerService\Domain\Subnet\Response\GetSubnetResponse;
use UnBlockerService\Infrastructure\Doctrine\Entity\Subnet;
use UnBlockerService\Infrastructure\Subnet\Provider\SubnetResourceProvider;

#[Immutable]
// #[ApiResource(
//    shortName: 'Subnet',
//    provider: SubnetDataProvider::class,
//    stateOptions: new Options(Subnet::class),
// )]
#[ApiResource(
    shortName: 'Subnet',
    operations: [
        new GetCollection(
            uriTemplate: '/subnets',
            output: GetSubnetResponse::class,
            provider: SubnetResourceProvider::class,
        ),
        new Get(
            uriTemplate: '/subnets/{id}',
            output: GetSubnetResponse::class,
            provider: SubnetResourceProvider::class,
            stateOptions: new Options(Subnet::class),
        ),
    ],
    class: Subnet::class,
    openapiContext: ['tags' => ['Subnets']],
    stateOptions: new Options(Subnet::class),
)]
final class GetSubnetRequest
{
    #[Assert\Country]
    public ?string $country;

    #[Assert\Ip]
    public ?string $address;

    #[Assert\Type(\DateTimeInterface::class)]
    #[Assert\DateTime(format: \DateTimeInterface::ATOM)]
    public ?\DateTimeImmutable $fromDateTime;

    #[Assert\Type(\DateTimeInterface::class)]
    #[Assert\DateTime(format: \DateTimeInterface::ATOM)]
    public ?\DateTimeImmutable $toDateTime;

    #[Assert\Type(DateTimeType::class)]
    public ?DateTimeType $dateTimeType;

    public function __construct(
        ?string $country = null,
        ?string $address = null,
        ?\DateTimeImmutable $fromDateTime = null,
        ?\DateTimeImmutable $toDateTime = null,
        ?DateTimeType $dateTimeType = null,
    ) {
        $this->country = $country;
        $this->address = $address;
        $this->fromDateTime = $fromDateTime;
        $this->toDateTime = $toDateTime;
        $this->dateTimeType = $dateTimeType;
    }
}
