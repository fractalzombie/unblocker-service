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

namespace UnBlockerService\Domain\Doctrine\Repository;

use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepositoryInterface as BaseServiceEntityRepositoryInterface;
use Doctrine\DBAL\LockMode;
use Doctrine\ORM\EntityManagerInterface;

/**
 * @psalm-template TEntity of object
 *
 * @template-extends BaseServiceEntityRepositoryInterface<TEntity>
 */
interface ServiceEntityRepositoryInterface extends BaseServiceEntityRepositoryInterface
{
    /** @psalm-param TEntity $entity */
    public function persist(object $entity): static;

    /** @psalm-param TEntity $entity */
    public function remove(object $entity): static;

    /** @psalm-param TEntity $entity */
    public function refresh(object $entity, LockMode $lockMode = LockMode::NONE): static;

    public function flush(): static;

    public function getRepositoryEntityManager(): EntityManagerInterface;
}
