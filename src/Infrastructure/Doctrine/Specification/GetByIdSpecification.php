<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Doctrine\Specification;

use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;
use Symfony\Component\Uid\Uuid;

final class GetByIdSpecification extends BaseSpecification
{
    public function __construct(
        private readonly Uuid $id,
        private readonly bool $neq = false,
    ) {
        parent::__construct();
    }

    protected function getSpec(): Filter
    {
        return $this->neq
            ? Spec::neq('id', $this->id)
            : Spec::eq('id', $this->id)
        ;
    }
}
