<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Entity;

use UnBlockerService\Common\Domain\Entity\ReadOnlyCountryInterface;
use UnBlockerService\Common\Domain\Entity\ReadOnlyCreatedAtInterface;
use UnBlockerService\Common\Domain\Entity\ReadOnlyIdentifierInterface;
use UnBlockerService\Subnet\Domain\Enum\SubnetState;

interface ReadOnlySubnetInterface extends ReadOnlyIdentifierInterface, ReadOnlyCountryInterface, ReadOnlyCreatedAtInterface
{
    public const SEPARATOR = '/';

    public function getExternalId(): ?string;

    public function getAddress(): string;

    public function getMask(): int;

    public function getCountry(): string;

    public function getState(): SubnetState;

    public function getSubnet(): string;

    public function getGroupName(): string;
}
