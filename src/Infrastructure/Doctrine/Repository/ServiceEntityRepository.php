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

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository as BaseServiceEntityRepository;
use Doctrine\ORM\EntityManagerInterface;
use UnBlockerService\Domain\Doctrine\Repository\ServiceEntityRepositoryInterface;

/**
 * @template TEntity
 *
 * @extends BaseServiceEntityRepository<TEntity>
 *
 * @implements ServiceEntityRepositoryInterface<TEntity>
 */
abstract class ServiceEntityRepository extends BaseServiceEntityRepository implements ServiceEntityRepositoryInterface
{
    public function persist(object $entity, bool $flush = true): static
    {
        $this->getEntityManager()->persist($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $this;
    }

    public function remove(object $entity, bool $flush = true): static
    {
        $this->getEntityManager()->remove($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $this;
    }

    public function update(object $entity, bool $flush = true): static
    {
        $this->getEntityManager()->refresh($entity);

        if ($flush) {
            $this->getEntityManager()->flush();
        }

        return $this;
    }

    public function getRepositoryEntityManager(): EntityManagerInterface
    {
        return $this->getEntityManager();
    }
}
