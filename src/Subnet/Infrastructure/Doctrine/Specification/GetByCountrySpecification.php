<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Doctrine\Specification;

use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Query\QueryModifier;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;

final class GetByCountrySpecification extends BaseSpecification
{
    public function __construct(
        private readonly string $country,
        private readonly bool $neq = false,
    ) {
        parent::__construct();
    }

    protected function getSpec(): Filter|QueryModifier
    {
        $country = trim(strtolower($this->country));

        return $this->neq
            ? Spec::neq(Spec::TRIM(Spec::lower('country')), $country)
            : Spec::eq(Spec::TRIM(Spec::lower('country')), $country)
        ;
    }
}
