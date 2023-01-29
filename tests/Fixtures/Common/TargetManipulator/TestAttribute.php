<?php

declare(strict_types=1);

namespace UnBlockerService\Tests\Fixtures\Common\TargetManipulator;

#[\Attribute(\Attribute::TARGET_CLASS | \Attribute::IS_REPEATABLE)]
readonly class TestAttribute
{
    public function __construct(
        public string $testProperty,
    ) {
    }
}
