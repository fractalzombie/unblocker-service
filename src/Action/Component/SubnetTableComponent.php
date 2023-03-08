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

#[AsLiveComponent('subnet_table')]
class SubnetTableComponent
{
    use DefaultActionTrait;

    #[LiveProp(writable: true)]
    public string $query = '';

    public function __construct(
        private readonly SubnetRepositoryInterface $subnetRepository,
    ) {
    }

    public function getSubnets(): array
    {
        return $this->subnetRepository->search($this->query);
    }
}
