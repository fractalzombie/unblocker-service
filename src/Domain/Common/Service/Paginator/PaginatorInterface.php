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

namespace UnBlockerService\Domain\Common\Service\Paginator;

use Doctrine\ORM\QueryBuilder;
use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use Happyr\DoctrineSpecification\Result\ResultModifier;
use UnBlockerService\Domain\Common\Service\Paginator\Exception\PaginatorException;
use UnBlockerService\Domain\Common\Service\Paginator\Model\PaginationInterface;
use UnBlockerService\Infrastructure\Common\Service\Paginator\PaginatorService;

/**
 * @template T of object
 */
#[AsAlias(PaginatorService::class)]
interface PaginatorInterface
{
    public function itemListQueryBuilder(QueryBuilder $queryBuilder): static;

    public function itemCountQueryBuilder(QueryBuilder $queryBuilder): static;

    public function itemListModifier(ResultModifier $modifier): static;
    public function itemCountModifier(ResultModifier $modifier): static;

    /**
     * Paginates item list query
     *
     * @param int $perPage
     * @param int $currentPage
     *
     * @return PaginationInterface<T>
     *
     * @throws PaginatorException
     */
    public function paginate(int $perPage, int $currentPage): PaginationInterface;
}
