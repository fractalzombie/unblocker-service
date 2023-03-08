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
