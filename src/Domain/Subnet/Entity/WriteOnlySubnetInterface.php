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
