<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Service\Downloader\Serializer\ValueObject;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Subnet\Domain\Entity\ReadOnlySubnetInterface;
use UnBlockerService\Subnet\Domain\Helper\SubnetHelper;

#[Immutable]
final readonly class Subnet implements \Stringable
{
    public function __construct(
        public string $address,
        public int $mask,
        public string $country,
    ) {
    }

    public function __toString(): string
    {
        return $this->getSubnet();
    }

    public static function fromSubnet(string $subnet, string $country): self
    {
        [$address, $mask] = SubnetHelper::getAddressAndMask($subnet);

        return new self($address, $mask, $country);
    }

    public function getSubnet(): string
    {
        return SubnetHelper::makeSubnets($this->address, $this->mask);
    }

    public static function unique(self $subnet): string
    {
        return $subnet->getSubnet();
    }
}
