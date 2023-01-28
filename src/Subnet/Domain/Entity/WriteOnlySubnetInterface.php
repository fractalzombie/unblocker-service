<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Entity;

use UnBlockerService\Common\Domain\Entity\WriteOnlyCountryInterface;
use UnBlockerService\Common\Domain\Entity\WriteOnlyCreatedAtInterface;
use UnBlockerService\Common\Domain\Entity\WriteOnlyUpdatedAtInterface;
use UnBlockerService\Subnet\Domain\Enum\SubnetState;

interface WriteOnlySubnetInterface extends WriteOnlyCreatedAtInterface, WriteOnlyCountryInterface, WriteOnlyUpdatedAtInterface
{
    public function setAddress(string $address): self;

    public function setExternalId(string $externalId): self;

    public function setMask(int $mask): self;

    public function setState(SubnetState $state): self;
}
