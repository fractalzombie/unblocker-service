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

namespace UnBlockerService\Tests\Fixtures\Common\TargetManipulator;

use UnBlockerService\Tests\Helper\TestHelper;

#[TestAttribute(TestHelper::ATTRIBUTE_PROPERTY_VALUE.'_02')]
#[TestAttribute(TestHelper::ATTRIBUTE_PROPERTY_VALUE.'_03')]
final readonly class TestClassSecondWithTestAttribute extends TestClassFirstWithTestAttribute
{
    public function __construct(
        string $testFirstProperty,
        public string $testSecondProperty,
    ) {
        parent::__construct($testFirstProperty);
    }
}
