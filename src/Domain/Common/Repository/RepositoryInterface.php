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

namespace UnBlockerService\Domain\Common\Repository;

use Doctrine\Common\Collections\Selectable;
use Doctrine\Persistence\ObjectRepository;
use Happyr\DoctrineSpecification\Repository\EntitySpecificationRepositoryInterface;

/**
 * @template T of object
 *
 * @extends ObjectRepository<T>|Selectable<int, T>
 */
interface RepositoryInterface extends EntitySpecificationRepositoryInterface, ObjectRepository, Selectable
{
}
