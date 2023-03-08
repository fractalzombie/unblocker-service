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

namespace UnBlockerService\Domain\Common\Service\Paginator\Model;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Infrastructure\Common\Service\Paginator\PaginatorService;

/** @template-covariant T of object */
interface PaginationInterface
{
    public function getPageCount(): int;

    public function getCurrentPage(): int;

    public function getPerPage(): int;

    /** @return T[] */
    public function getItemList(): iterable;
}
