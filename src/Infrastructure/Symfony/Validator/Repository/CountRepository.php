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

namespace UnBlockerService\Infrastructure\Symfony\Validator\Repository;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;

/**
 * @psalm-template TEntity of object
 *
 * @psalm-implements CountRepositoryInterface<TEntity>
 */
#[Autoconfigure]
readonly class CountRepository implements CountRepositoryInterface
{
    public function __construct(
        private EntityManagerInterface $entityManager,
    ) {}

    /** @psalm-param class-string<TEntity> $class */
    public function getCountOf(string $class, string $property, mixed $value, string $idProperty, mixed $notId = null): int
    {
        $queryBuilder = $this->entityManager->createQueryBuilder();

        if (\is_array($value)) {
            $value = array_map(static fn ($v) => \is_string($v) ? strtolower($v) : $v, $value);

            $searchValueWhere = $queryBuilder
                ->expr()
                ->in("lower(entity.{$property})", ':value');
        } else {
            $searchValueWhere = $queryBuilder
                ->expr()
                ->eq("lower(entity.{$property})", 'lower(:value)');
        }

        $queryBuilder
            ->select($queryBuilder->expr()->count("entity.{$idProperty}"))
            ->from($class, 'entity')
            ->where($searchValueWhere)
            ->setParameter('value', $value);

        if ($notId) {
            $notIdWhere = $queryBuilder->expr()->neq("entity.{$idProperty}", ':notId');
            $queryBuilder->andWhere($notIdWhere)->setParameter('notId', $notId);
        }

        try {
            $count = (int) $queryBuilder
                ->getQuery()
                ->getSingleScalarResult();
        } catch (NoResultException) {
            $count = 0;
        } catch (NonUniqueResultException) {
            $count = 1;
        } finally {
            return $count;
        }
    }
}
