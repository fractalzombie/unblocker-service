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

namespace UnBlockerService\Infrastructure\Subnet\Specification;

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
