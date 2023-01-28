<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Request;

use Doctrine\DBAL\Types\DateTimeType;
use JetBrains\PhpStorm\Immutable;
use Symfony\Component\Validator\Constraints as Assert;
use UnBlockerService\Common\Infrastructure\Symfony\Validator\Constraints\Enum;

#[Immutable]
final readonly class GetSubnetRequest
{
    #[Assert\Country]
    public ?string $country;

    #[Assert\Ip]
    public ?string $address;

    #[Assert\DateTime(format: \DateTimeInterface::ATOM)]
    public ?\DateTimeImmutable $fromDateTime;

    #[Assert\DateTime(format: \DateTimeInterface::ATOM)]
    public ?\DateTimeImmutable $toDateTime;

    #[Enum(DateTimeType::class)]
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
