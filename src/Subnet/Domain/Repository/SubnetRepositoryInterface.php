<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Repository;

use Doctrine\ORM\EntityRepository;
use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use Happyr\DoctrineSpecification\Repository\EntitySpecificationRepositoryInterface;
use Symfony\Component\Uid\Uuid;
use UnBlockerService\Subnet\Domain\Entity\SubnetInterface;
use UnBlockerService\Subnet\Domain\Enum\SubnetState;
use UnBlockerService\Subnet\Infrastructure\Doctrine\Repository\SubnetRepository;

/**
 * @extends EntityRepository<SubnetInterface>
 */
#[AsAlias(SubnetRepository::class)]
interface SubnetRepositoryInterface extends EntitySpecificationRepositoryInterface
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
