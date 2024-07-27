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

namespace UnBlockerService\Domain\Subnet\Repository;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Component\Uid\Uuid;
use UnBlockerService\Domain\Doctrine\Repository\ServiceEntityRepositoryInterface;
use UnBlockerService\Domain\Subnet\Entity\SubnetInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Infrastructure\Doctrine\Repository\SubnetRepository;

#[AsAlias(SubnetRepository::class)]
interface SubnetRepositoryInterface extends ServiceEntityRepositoryInterface
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
