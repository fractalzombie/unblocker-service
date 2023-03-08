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

namespace UnBlockerService\Infrastructure\Subnet\Repository;

use Doctrine\ORM\EntityManagerInterface;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use Happyr\DoctrineSpecification\Result\Cache;
use Happyr\DoctrineSpecification\Result\ResultModifierCollection;
use Symfony\Component\Uid\Uuid;
use UnBlockerService\Domain\Common\Service\Paginator\PaginatorInterface;
use UnBlockerService\Domain\Subnet\Entity\SubnetInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Infrastructure\Doctrine\Entity\Subnet;
use UnBlockerService\Infrastructure\Doctrine\Repository\AbstractRepositoryWithPagination;
use UnBlockerService\Infrastructure\Subnet\Specification\GetByAddressAndMaskSpecification;
use UnBlockerService\Infrastructure\Subnet\Specification\GetByAddressSpecification;
use UnBlockerService\Infrastructure\Subnet\Specification\GetByCountrySpecification;
use UnBlockerService\Infrastructure\Subnet\Specification\GetByIdSpecification;
use UnBlockerService\Infrastructure\Subnet\Specification\GetByStateSpecification;

/**
 * @template T of Subnet
 *
 * @extends AbstractRepositoryWithPagination<T>
 */
#[AsService(arguments: ['$cacheSeconds' => '%env(int:DATABASE_SUBNET_CACHE_SECONDS)%'])]
final class SubnetRepository extends AbstractRepositoryWithPagination implements SubnetRepositoryInterface
{
    public function __construct(
        int $cacheSeconds,
        EntityManagerInterface $entityManager,
        PaginatorInterface $paginator,
    ) {
        parent::__construct($cacheSeconds, Subnet::class, $entityManager, $paginator);
    }

    public function search(?string $query): array
    {
        $queryBuilder = $this->createQueryBuilder('subnet');

        return $queryBuilder
            ->where($queryBuilder->expr()->like('subnet.address', ':address'))
            ->setParameter('address', "%{$query}%")
            ->getQuery()
            ->getResult()
        ;
    }

    public function getOneById(Uuid $id): ?SubnetInterface
    {
        return $this->matchOneOrNullResult(
            new GetByIdSpecification($id),
            new Cache($this->cacheSeconds),
        );
    }

    public function getOneByCountry(string $country): ?SubnetInterface
    {
        return $this->matchOneOrNullResult(
            new GetByCountrySpecification($country),
            new Cache($this->cacheSeconds),
        );
    }

    /** @return SubnetInterface[] */
    public function getListByCountry(string $country): array
    {
        return $this->match(
            new GetByCountrySpecification($country),
            new ResultModifierCollection(new Cache($this->cacheSeconds)),
        );
    }

    public function getOneByAddress(string $address): ?SubnetInterface
    {
        return $this->matchOneOrNullResult(
            new GetByAddressSpecification($address),
            new Cache($this->cacheSeconds),
        );
    }

    public function getListByAddress(string $address): array
    {
        return $this->match(
            new GetByAddressSpecification($address),
            new ResultModifierCollection(new Cache($this->cacheSeconds)),
        );
    }

    public function getOneByAddressAndMask(string $address, int $mask): ?SubnetInterface
    {
        return $this->matchOneOrNullResult(
            new GetByAddressAndMaskSpecification($address, $mask),
            new Cache($this->cacheSeconds),
        );
    }

    public function isExistByAddressAndMask(string $address, int $mask): bool
    {
        return (bool) $this->count(['address' => $address, 'mask' => $mask]);
    }

    public function getByStates(SubnetState ...$states): array
    {
        return $this->match(
            new GetByStateSpecification(...$states),
            new Cache($this->cacheSeconds),
        );
    }
}
