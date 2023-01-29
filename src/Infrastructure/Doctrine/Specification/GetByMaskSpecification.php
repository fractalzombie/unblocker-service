<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Doctrine\Specification;

use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;

final class GetByMaskSpecification extends BaseSpecification
{
    public function __construct(
        private readonly int $mask,
        private readonly bool $neq = false,
    ) {
        parent::__construct();
    }

    protected function getSpec(): Filter
    {
        return $this->neq
            ? Spec::neq('mask', $this->mask)
            : Spec::eq('mask', $this->mask)
        ;
    }
}
