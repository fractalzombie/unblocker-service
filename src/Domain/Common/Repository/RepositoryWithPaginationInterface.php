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

use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Query\QueryModifier;
use Happyr\DoctrineSpecification\Result\ResultModifier;
use UnBlockerService\Domain\Common\Service\Paginator\Model\PaginationInterface;

/**
 * @template T of object
 */
interface RepositoryWithPaginationInterface
{
    /**
     * @param int $perPage
     * @param int $currentPage
     *
     * @return PaginationInterface<T>
     */
    public function filterWithPagination(int $perPage, int $currentPage): PaginationInterface;
}
