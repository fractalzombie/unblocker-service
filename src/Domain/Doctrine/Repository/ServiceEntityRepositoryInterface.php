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
use Doctrine\ORM\EntityManagerInterface;

/**
 * @template TEntity
 *
 * @extends BaseServiceEntityRepositoryInterface<TEntity>
 */
interface ServiceEntityRepositoryInterface extends BaseServiceEntityRepositoryInterface
{
    public function persist(object $entity, bool $flush = true): static;

    public function remove(object $entity, bool $flush = true): static;

    public function update(object $entity, bool $flush = true): static;

    public function getRepositoryEntityManager(): EntityManagerInterface;
}
