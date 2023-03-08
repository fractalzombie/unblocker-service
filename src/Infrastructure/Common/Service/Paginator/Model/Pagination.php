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

namespace UnBlockerService\Infrastructure\Common\Service\Paginator\Model;

use UnBlockerService\Domain\Common\Service\Paginator\Model\PaginationInterface;

/**
 * @template T of object
 *
 * @implements PaginationInterface<T>
 */
final readonly class Pagination implements PaginationInterface
{
    /** @param T[] $itemList */
    public function __construct(
        private int $currentPage,
        private int $perPage,
        private int $pageCount,
        private iterable $itemList = [],
    ) {
    }

    public function getPageCount(): int
    {
        return $this->pageCount;
    }

    public function getCurrentPage(): int
    {
        return $this->currentPage;
    }

    public function getPerPage(): int
    {
        return $this->perPage;
    }

    /** @return T[] */
    public function getItemList(): iterable
    {
        return $this->itemList;
    }
}
