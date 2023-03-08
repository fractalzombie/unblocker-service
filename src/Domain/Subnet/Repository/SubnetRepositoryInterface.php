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

namespace UnBlockerService\Domain\Subnet\Repository;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\Uid\Uuid;
use UnBlockerService\Domain\Common\Repository\RepositoryInterface;
use UnBlockerService\Domain\Common\Repository\RepositoryWithPaginationInterface;
use UnBlockerService\Domain\Subnet\Entity\SubnetInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Infrastructure\Subnet\Repository\SubnetRepository;

/**
 * @extends RepositoryInterface<SubnetInterface>|RepositoryWithPaginationInterface<SubnetInterface>
 */
#[AsAlias(SubnetRepository::class)]
interface SubnetRepositoryInterface extends RepositoryInterface, RepositoryWithPaginationInterface
{
    public function getOneById(Uuid $id): ?SubnetInterface;

    public function getOneByCountry(string $country): ?SubnetInterface;

    /** @return SubnetInterface[] */
    public function getListByCountry(string $country): array;

    public function getOneByAddress(string $address): ?SubnetInterface;

    /** @return SubnetInterface[] */
    public function getListByAddress(string $address): array;

    public function getOneByAddressAndMask(string $address, int $mask): ?SubnetInterface;

    public function isExistByAddressAndMask(string $address, int $mask): bool;

    public function getByStates(SubnetState ...$states): array;
}
