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

namespace UnBlockerService\Action\Component;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveProp;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Infrastructure\Common\Service\Paginator\Model\Pagination;

#[AsLiveComponent('subnet_list')]
class SubnetListComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public int $currentPage = 0;

    #[LiveProp]
    public int $perPage = 10;

    #[LiveProp]
    public int $pageCount = 0;

    #[LiveProp]
    public array $subnetList = [];

    public function __construct(
        private readonly SubnetRepositoryInterface $subnetRepository,
    ) {
    }

    public function mount(bool $isSuccess = true): void
    {
        $pagination = $this->getPagination();
        $this->perPage = $pagination->getPerPage();
        $this->currentPage = $pagination->getCurrentPage();
        $this->pageCount = $pagination->getPageCount();
        $this->subnetList = $pagination->getItemList();
    }

    public function getPagination(): Pagination
    {
        return $this->subnetRepository->filterWithPagination($this->perPage, $this->currentPage);
    }
}
