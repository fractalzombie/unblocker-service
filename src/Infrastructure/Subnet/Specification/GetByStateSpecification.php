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
use Happyr\DoctrineSpecification\Spec;
use Happyr\DoctrineSpecification\Specification\BaseSpecification;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;

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
