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
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;
use UnBlockerService\Domain\Doctrine\Repository\ServiceEntityRepositoryInterface;

/**
 * @psalm-template TEntity of object
 *
 * @template-extends BaseServiceEntityRepository<TEntity>
 *
 * @template-implements ServiceEntityRepositoryInterface<TEntity>
 */
abstract class ServiceEntityRepository extends BaseServiceEntityRepository implements ServiceEntityRepositoryInterface
{
    public function persist(object $entity): static
    {
        $this->getEntityManager()->persist($entity);

        return $this;
    }

    public function remove(object $entity): static
    {
        $this->getEntityManager()->remove($entity);

        return $this;
    }

    public function refresh(object $entity, LockMode $lockMode = LockMode::NONE): static
    {
        $this->getEntityManager()->refresh($entity, $lockMode);

        return $this;
    }

    public function flush(): static
    {
        $this->getEntityManager()->flush();

        return $this;
    }

    public function getRepositoryEntityManager(): EntityManagerInterface
    {
        return $this->getEntityManager();
    }
}
