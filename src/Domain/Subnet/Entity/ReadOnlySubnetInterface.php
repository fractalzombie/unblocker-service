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

use UnBlockerService\Domain\Common\Entity\ReadOnlyCountryInterface;
use UnBlockerService\Domain\Common\Entity\ReadOnlyCreatedAtInterface;
use UnBlockerService\Domain\Common\Entity\ReadOnlyIdentifierInterface;
use UnBlockerService\Domain\Common\Entity\ReadOnlyUpdatedAtInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;

interface ReadOnlySubnetInterface extends ReadOnlyIdentifierInterface, ReadOnlyCountryInterface, ReadOnlyCreatedAtInterface, ReadOnlyUpdatedAtInterface
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
