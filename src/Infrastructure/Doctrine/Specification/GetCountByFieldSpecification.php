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

namespace UnBlockerService\Infrastructure\Doctrine\Specification;

use Happyr\DoctrineSpecification\Filter\Filter;
use Happyr\DoctrineSpecification\Query\QueryModifier;
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;

class GetCountByFieldSpecification extends BaseSpecification
{
    public function __construct(
        private readonly string $field,
    ) {
        parent::__construct();
    }

    protected function getSpec(): Filter|QueryModifier
    {
        return Spec::countOf(
            Spec::select(
                Spec::field($this->field),
            ),
        );
    }
}
