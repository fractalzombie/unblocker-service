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

namespace UnBlockerService\Infrastructure\Doctrine\Repository;

use Happyr\DoctrineSpecification\Repository\EntitySpecificationRepository;
use UnBlockerService\Domain\Common\Repository\RepositoryInterface;

/**
 * @template T of object
 *
 * @extends EntitySpecificationRepository<T>
 *
 * @implements RepositoryInterface<T>
 */
abstract class AbstractRepository extends EntitySpecificationRepository implements RepositoryInterface
{
}
