<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Doctrine\Specification;

use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;
use UnBlockerService\Subnet\Domain\Enum\SubnetState;

final class GetByStateSpecification extends BaseSpecification
{
    private readonly array $states;

    public function __construct(
        SubnetState ...$states,
    ) {
        $this->states = $states;
        parent::__construct();
    }

    protected function getSpec(): Filter
    {
        return Spec::in('state', $this->states);
    }
}
