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

final class GetByAddressAndMaskSpecification extends BaseSpecification
{
    public function __construct(
        private readonly string $address,
        private readonly int $mask,
    ) {
        parent::__construct();
    }

    protected function getSpec(): Filter
    {
        return Spec::andX(
            new GetByAddressSpecification($this->address),
            new GetByMaskSpecification($this->mask),
        );
    }
}
