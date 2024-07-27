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

namespace UnBlockerService\Infrastructure\Doctrine\Repository;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bridge\Doctrine\Types\UuidType;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use Symfony\Component\Uid\Uuid;
use UnBlockerService\Domain\Subnet\Entity\SubnetInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Infrastructure\Doctrine\Entity\Subnet;

/**
 * @template-extends ServiceEntityRepository<SubnetInterface>
 *
 * @template-implements SubnetRepositoryInterface<SubnetInterface>
 */
final class SubnetRepository extends ServiceEntityRepository implements SubnetRepositoryInterface
{
    public function __construct(
        ManagerRegistry $registry,
        #[Autowire(env: 'DATABASE_SUBNET_CACHE_SECONDS')]
        private readonly int $cacheSeconds,
    ) {
        parent::__construct($registry, Subnet::class);
    }

    public function getOneById(Uuid $id): ?SubnetInterface
    {
        $qb = $this->createQueryBuilder('subnet');

        $qb
            ->where($qb->expr()->eq('subnet.id', ':id'))
            ->setParameter('id', $id, UuidType::NAME);

        try {
            return $qb
                ->getQuery()
                ->setQueryCacheLifetime($this->cacheSeconds)
                ->getSingleResult();
        } catch (NonUniqueResultException|NoResultException $e) {
            return null;
        }

        //        return $this->matchOneOrNullResult(
        //            new GetByIdSpecification($id),
        //            new Cache($this->cacheSeconds),
        //        );
    }

    public function getOneByCountry(string $country): ?SubnetInterface
    {
        $qb = $this->createQueryBuilder('subnet');

        $qb
            ->where($qb->expr()->eq('subnet.country', ':country'))
            ->setParameter('country', $country);

        try {
            return $qb
                ->getQuery()
                ->setQueryCacheLifetime($this->cacheSeconds)
                ->getSingleResult();
        } catch (NonUniqueResultException|NoResultException) {
            return null;
        }

        //        return $this->matchOneOrNullResult(
        //            new GetByCountrySpecification($country),
        //            new Cache($this->cacheSeconds),
        //        );
    }

    /** @psalm-return SubnetInterface[] */
    public function getListByCountry(string $country): array
    {
        $qb = $this->createQueryBuilder('subnet');

        $qb
            ->where($qb->expr()->eq('subnet.country', ':country'))
            ->setParameter('country', $country);

        return $qb
            ->getQuery()
            ->setQueryCacheLifetime($this->cacheSeconds)
            ->getResult();

        //        return $this->match(
        //            new GetByCountrySpecification($country),
        //            new ResultModifierCollection(new Cache($this->cacheSeconds)),
        //        );
    }

    public function getOneByAddress(string $address): ?SubnetInterface
    {
        $qb = $this->createQueryBuilder('subnet');

        $qb
            ->where($qb->expr()->eq('subnet.address', ':address'))
            ->setParameter('address', $address);

        try {
            return $qb
                ->getQuery()
                ->setQueryCacheLifetime($this->cacheSeconds)
                ->getSingleResult();
        } catch (NonUniqueResultException|NoResultException) {
            return null;
        }

        //        return $this->matchOneOrNullResult(
        //            new GetByAddressSpecification($address),
        //            new Cache($this->cacheSeconds),
        //        );
    }

    public function getListByAddress(string $address): array
    {
        $qb = $this->createQueryBuilder('subnet');

        $qb
            ->where($qb->expr()->eq('subnet.address', ':address'))
            ->setParameter('address', $address);

        return $qb
            ->getQuery()
            ->setQueryCacheLifetime($this->cacheSeconds)
            ->getResult();

        //        return $this->match(
        //            new GetByAddressSpecification($address),
        //            new ResultModifierCollection(new Cache($this->cacheSeconds)),
        //        );
    }

    public function getOneByAddressAndMask(string $address, int $mask): ?SubnetInterface
    {
        $qb = $this->createQueryBuilder('subnet');

        $qb
            ->where(
                $qb->expr()->andX(
                    $qb->expr()->eq('subnet.address', ':address'),
                    $qb->expr()->eq('subnet.mask', ':mask'),
                )
            )
            ->setParameter('address', $address)
            ->setParameter('mask', $mask);

        return $qb
            ->getQuery()
            ->setQueryCacheLifetime($this->cacheSeconds)
            ->getResult();

        //        return $this->matchOneOrNullResult(
        //            new GetByAddressAndMaskSpecification($address, $mask),
        //            new Cache($this->cacheSeconds),
        //        );
    }

    public function isExistByAddressAndMask(string $address, int $mask): bool
    {
        return (bool) $this->count(['address' => $address, 'mask' => $mask]);
    }

    public function getByStates(SubnetState ...$states): array
    {
        $qb = $this->createQueryBuilder('subnet');

        $qb
            ->where($qb->expr()->in('subnet.state', ':states'))
            ->setParameter('states', $states);

        return $qb
            ->getQuery()
            ->setQueryCacheLifetime($this->cacheSeconds)
            ->getResult();

        //        return $this->match(
        //            new GetByStateSpecification(...$states),
        //            new Cache($this->cacheSeconds),
        //        );
    }
}
