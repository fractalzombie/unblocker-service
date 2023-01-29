<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface;
use Doctrine\ORM\EntityRepository;
use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use Happyr\DoctrineSpecification\Repository\EntitySpecificationRepository;
use Happyr\DoctrineSpecification\Repository\EntitySpecificationRepositoryInterface;
use Symfony\Component\Uid\Uuid;
use UnBlockerService\Domain\Subnet\Entity\SubnetInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Infrastructure\Doctrine\Repository\SubnetRepository;

/**
 * @template T of SubnetInterface
 * @extends EntitySpecificationRepository<T>
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
