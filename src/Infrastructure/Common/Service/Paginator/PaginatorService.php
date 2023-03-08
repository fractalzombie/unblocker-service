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

namespace UnBlockerService\Infrastructure\Common\Service\Paginator;

use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\ORM\NoResultException;
use Doctrine\ORM\QueryBuilder;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use Happyr\DoctrineSpecification\Result\ResultModifier;
use UnBlockerService\Domain\Common\Service\Paginator\Exception\PaginatorException;
use UnBlockerService\Domain\Common\Service\Paginator\Model\PaginationInterface;
use UnBlockerService\Domain\Common\Service\Paginator\PaginatorInterface;
use UnBlockerService\Infrastructure\Common\Service\Paginator\Model\Pagination;

/**
 * @template T of object
 *
 * @implements PaginatorInterface<T>
 */
#[AsService]
class PaginatorService implements PaginatorInterface
{
    private const DEFAULT_PER_PAGE_COUNT = 50;
    private const DEFAULT_PAGE_NUMBER = 1;

    private ?QueryBuilder $itemListQueryBuilder = null;
    private ?ResultModifier $itemListModifier = null;
    private ?QueryBuilder $itemCountQueryBuilder = null;
    private ?ResultModifier $itemCountModifier = null;
    private int $perPage = self::DEFAULT_PER_PAGE_COUNT;
    private int $currentPage = self::DEFAULT_PAGE_NUMBER;

    public function itemListQueryBuilder(QueryBuilder $queryBuilder): static
    {
        $this->itemListQueryBuilder = $queryBuilder;

        return $this;
    }

    public function itemCountQueryBuilder(QueryBuilder $queryBuilder): static
    {
        $this->itemCountQueryBuilder = $queryBuilder;

        return $this;
    }

    public function itemListModifier(ResultModifier $modifier): static
    {
        $this->itemListModifier = $modifier;

        return $this;
    }

    public function itemCountModifier(ResultModifier $modifier): static
    {
        $this->itemCountModifier = $modifier;

        return $this;
    }

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
    public function paginate(int $perPage, int $currentPage): PaginationInterface
    {
        try {
            $currentPage = $currentPage > 0 ? $currentPage - 1 : $currentPage;
            $itemCount = $this->getItemCount();
            $pageCount = (int) round($itemCount / $this->perPage);
            $itemList = $this->getItemList($perPage, $currentPage);

            return new Pagination($currentPage, $perPage, $pageCount, $itemList);
        } catch (NoResultException|NonUniqueResultException $e) {
            throw PaginatorException::fromThrowable($e);
        }
    }

    private function getItemList(int $perPage, int $currentPage): array
    {
        $this->itemListQueryBuilder ?? throw PaginatorException::isNull('itemListQueryBuilder');

        $itemListQuery = $this->itemListQueryBuilder
            ->setFirstResult((int) round($perPage * $currentPage))
            ->setMaxResults($perPage)
            ->getQuery()
        ;

        return $this
            ->modifyQuery($itemListQuery, $this->itemListModifier)
            ->getResult()
        ;
    }

    /** @throws NoResultException|NonUniqueResultException */
    private function getItemCount(): int
    {
        $this->itemCountQueryBuilder ?? throw PaginatorException::isNull('itemListQueryBuilder');

        return $this
            ->modifyQuery($this->itemCountQueryBuilder->getQuery(), $this->itemCountModifier)
            ->getSingleScalarResult()
        ;
    }

    private function modifyQuery(AbstractQuery $query, ?ResultModifier $modifier = null): AbstractQuery
    {
        $modifier?->modify($query);

        return $query;
    }
}
