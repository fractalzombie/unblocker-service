<?php

declare(strict_types=1);

namespace UnBlockerService\Tests\Fixtures\Common\TargetManipulator;

use UnBlockerService\Tests\Helper\TestHelper;

#[TestAttribute(TestHelper::ATTRIBUTE_PROPERTY_VALUE.'_01')]
readonly class TestClassFirstWithTestAttribute
{
    public function __construct(
        public string $testFirstProperty,
    ) {
    }
}
