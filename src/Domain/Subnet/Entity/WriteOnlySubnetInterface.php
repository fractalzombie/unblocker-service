<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Entity;

use UnBlockerService\Domain\Common\Entity\WriteOnlyCountryInterface;
use UnBlockerService\Domain\Common\Entity\WriteOnlyCreatedAtInterface;
use UnBlockerService\Domain\Common\Entity\WriteOnlyIdentifierInterface;
use UnBlockerService\Domain\Common\Entity\WriteOnlyUpdatedAtInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;

interface WriteOnlySubnetInterface extends WriteOnlyIdentifierInterface, WriteOnlyCreatedAtInterface, WriteOnlyCountryInterface, WriteOnlyUpdatedAtInterface
{
    public function setAddress(string $address): self;

    public function setExternalId(string $externalId): self;

    public function setMask(int $mask): self;

    public function setState(SubnetState $state): self;
}
