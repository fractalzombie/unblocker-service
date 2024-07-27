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

namespace UnBlockerService\Domain\Subnet\Request;

use Doctrine\DBAL\Types\DateTimeType;
use JetBrains\PhpStorm\Immutable;
use Symfony\Component\Validator\Constraints as Assert;

#[Immutable]
final readonly class GetSubnetRequest
{
    #[Assert\Country]
    public ?string $country;

    #[Assert\Ip]
    public ?string $address;

    #[Assert\Type(\DateTimeInterface::ATOM)]
    #[Assert\DateTime(format: \DateTimeInterface::ATOM)]
    public ?\DateTimeImmutable $fromDateTime;

    #[Assert\Type(\DateTimeInterface::ATOM)]
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
