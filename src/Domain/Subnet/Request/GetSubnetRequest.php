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

namespace UnBlockerService\Domain\Subnet\Request;

use Doctrine\DBAL\Types\DateTimeType;
use JetBrains\PhpStorm\Immutable;
use Symfony\Component\Validator\Constraints as Assert;
use UnBlockerService\Infrastructure\Symfony\Validator\Constraints\Enum;

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
