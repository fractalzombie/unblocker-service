<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Doctrine\Specification;

use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;

final class GetByAddressSpecification extends BaseSpecification
{
    public function __construct(
        private readonly string $address,
        private readonly bool $neq = false,
    ) {
        parent::__construct();
    }

    protected function getSpec(): Filter
    {
        return $this->neq
            ? Spec::neq('address', $this->address)
            : Spec::eq('address', $this->address)
        ;
    }
}
