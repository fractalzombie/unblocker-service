<?php

declare(strict_types=1);

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
