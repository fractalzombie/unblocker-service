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

use Doctrine\ORM\EntityManagerInterface;
use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Query\QueryModifier;
use Happyr\DoctrineSpecification\Result\Cache;
use Happyr\DoctrineSpecification\Result\ResultModifier;
use Happyr\DoctrineSpecification\Result\ResultModifierCollection;
use UnBlockerService\Domain\Common\Repository\RepositoryWithPaginationInterface;
use UnBlockerService\Domain\Common\Service\Paginator\Model\PaginationInterface;
use UnBlockerService\Domain\Common\Service\Paginator\PaginatorInterface;
use UnBlockerService\Infrastructure\Common\Service\Paginator\Model\Pagination;
use UnBlockerService\Infrastructure\Doctrine\Specification\GetCountByFieldSpecification;
use UnBlockerService\Infrastructure\Doctrine\Specification\GetWithLimitAndOffsetSpecification;

/**
 * @template T of object
 *
 * @extends AbstractRepository<T>
 *
 * @implements RepositoryWithPaginationInterface<T>
 */
abstract class AbstractRepositoryWithPagination extends AbstractRepository implements RepositoryWithPaginationInterface
{
    /**
     * @param class-string<T> $className
     * @param PaginatorInterface<T> $paginator
     */
    public function __construct(
        protected readonly int $cacheSeconds,
        string $className,
        EntityManagerInterface $em,
        protected readonly PaginatorInterface $paginator,
    ) {
        parent::__construct($em, $em->getClassMetadata($className));
    }

    /** {@inheritdoc} */
    public function filterWithPagination(int $perPage, int $currentPage): PaginationInterface
    {
        return $this->paginator
            ->itemCountQueryBuilder($this->getQueryBuilder(new GetCountByFieldSpecification('id')))
            ->itemCountModifier(new ResultModifierCollection(new Cache($this->cacheSeconds)))
            ->itemListQueryBuilder($this->getQueryBuilder(new GetWithLimitAndOffsetSpecification($perPage, $currentPage)))
            ->itemListModifier(new Cache($this->cacheSeconds))
            ->paginate($perPage, $currentPage)
        ;
    }
}
