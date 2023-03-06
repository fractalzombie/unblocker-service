<?php

declare(strict_types=1);

namespace UnBlockerService\Action\Component;

use Symfony\UX\LiveComponent\Attribute\AsLiveComponent;
use Symfony\UX\LiveComponent\Attribute\LiveAction;
use Symfony\UX\LiveComponent\ComponentWithFormTrait;
use Symfony\UX\LiveComponent\DefaultActionTrait;
use Symfony\UX\LiveComponent\LiveCollectionTrait;
use UnBlockerService\Domain\Subnet\Entity\ReadOnlySubnetInterface;
use UnBlockerService\Domain\Subnet\Entity\SubnetInterface;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Infrastructure\Doctrine\Entity\Subnet;

#[AsLiveComponent('subnet_list')]
class SubnetListComponent
{
    use DefaultActionTrait;

    public function __construct(
        private readonly SubnetRepositoryInterface $subnetRepository,
    ) {
    }

    /** @return ReadOnlySubnetInterface[] */
    public function getSubnets(): array
    {
        $subnets = $this->subnetRepository
            ->createQueryBuilder('s')
            ->getQuery()
            ->getResult()
        ;

        return $subnets;
    }
}
