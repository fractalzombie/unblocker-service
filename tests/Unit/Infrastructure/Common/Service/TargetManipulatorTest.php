<?php

declare(strict_types=1);

namespace UnBlockerService\Tests\Unit\Infrastructure\Common\Service;

use UnBlockerService\Domain\Common\Service\Manipulator\Exception\ManipulatorException;
use UnBlockerService\Infrastructure\Common\Service\Manipulator\TargetManipulator;
use UnBlockerService\Tests\Fixtures\Common\TargetManipulator\TestAttribute;
use UnBlockerService\Tests\Fixtures\Common\TargetManipulator\TestClassFirstWithTestAttribute;
use UnBlockerService\Tests\Fixtures\Common\TargetManipulator\TestClassSecondWithTestAttribute;
use UnBlockerService\Tests\Helper\TestHelper;

test('test TargetManipulator::getShortName()', function (array $arguments, string $expectedValue, bool $testMethodThrows): void {
    if ($testMethodThrows) {
        $this->expectException(ManipulatorException::class);
    }

    expect((new TargetManipulator())->getShortName(...$arguments))->toBe($expectedValue);
})->with(function () {
    yield 'Success' => [
        'arguments' => ['target' => TestClassFirstWithTestAttribute::class],
        'expectedValue' => 'TestClassFirstWithTestAttribute',
        'testMethodThrows' => false,
    ];

    yield 'Failure' => [
        'arguments' => ['target' => TargetManipulator::DEFAULT_SHORT_CLASS_NAME],
        'expectedValue' => 'TargetManipulator::DEFAULT_SHORT_CLASS_NAME',
        'testMethodThrows' => true,
    ];
});

test('test TargetManipulator::getAttributesOf()', function (array $arguments, array $expectedValue, bool $testMethodThrows): void {
    if ($testMethodThrows) {
        $this->expectException(ManipulatorException::class);
    }

    $executedValue = (new TargetManipulator())->getAttributesOf(...$arguments);

    expect($executedValue[0]->testProperty)->toBe($expectedValue[0]->testProperty)
        ->and($executedValue[1]->testProperty)->toBe($expectedValue[1]->testProperty)
    ;
})->with(function () {
    yield 'Success' => [
        'arguments' => [
            'target' => TestClassSecondWithTestAttribute::class,
            'attributeClass' => TestAttribute::class,
        ],
        'expectedValue' => [
            new TestAttribute(TestHelper::ATTRIBUTE_PROPERTY_VALUE.'_01'),
            new TestAttribute(TestHelper::ATTRIBUTE_PROPERTY_VALUE.'_02'),
            new TestAttribute(TestHelper::ATTRIBUTE_PROPERTY_VALUE.'_03'),
        ],
        'testMethodThrows' => false,
    ];

    yield 'Failure attribute class invalid' => [
        'arguments' => [
            'target' => TestClassSecondWithTestAttribute::class,
            'attributeClass' => 'NotValidAttribute',
        ],
        'expectedValue' => [],
        'testMethodThrows' => true,
    ];

    yield 'Failure target invalid' => [
        'arguments' => [
            'target' => 'NotValidClass',
            'attributeClass' => TestAttribute::class,
        ],
        'expectedValue' => [],
        'testMethodThrows' => true,
    ];
});

test('test TargetManipulator::getReflectionAttributesOf()', function (array $arguments, array $expectedValue, bool $testMethodThrows): void {
    if ($testMethodThrows) {
        $this->expectException(ManipulatorException::class);
    }

    $executedValue = (new TargetManipulator())->getReflectionAttributes(...$arguments);

    expect($executedValue[0]->newInstance()->testProperty)->toBe($expectedValue[0]->testProperty)
        ->and($executedValue[1]->newInstance()->testProperty)->toBe($expectedValue[1]->testProperty)
        ->and($executedValue[2]->newInstance()->testProperty)->toBe($expectedValue[2]->testProperty)
    ;
})->with(function () {
    yield 'Success' => [
        'arguments' => [
            'target' => TestClassSecondWithTestAttribute::class,
            'attributeClass' => TestAttribute::class,
        ],
        'expectedValue' => [
            new TestAttribute(TestHelper::ATTRIBUTE_PROPERTY_VALUE.'_01'),
            new TestAttribute(TestHelper::ATTRIBUTE_PROPERTY_VALUE.'_02'),
            new TestAttribute(TestHelper::ATTRIBUTE_PROPERTY_VALUE.'_03'),
        ],
        'testMethodThrows' => false,
    ];

    yield 'Failure attribute class invalid' => [
        'arguments' => [
            'target' => TestClassSecondWithTestAttribute::class,
            'attributeClass' => 'NotValidAttribute',
        ],
        'expectedValue' => [],
        'testMethodThrows' => true,
    ];

    yield 'Failure target invalid' => [
        'arguments' => [
            'target' => 'NotValidClass',
            'attributeClass' => TestAttribute::class,
        ],
        'expectedValue' => [],
        'testMethodThrows' => true,
    ];
});

test('test TargetManipulator::getPropertiesOf()', function (array $arguments, array $expectedValue, bool $testMethodThrows): void {
    if ($testMethodThrows) {
        $this->expectException(ManipulatorException::class);
    }

    $executedValue = (new TargetManipulator())->getPropertiesOf(...$arguments);

    expect($executedValue[0]->getName())->toBe($expectedValue[0])
        ->and($executedValue[1]->getName())->toBe($expectedValue[1])
    ;
})->with(function () {
    yield 'Success' => [
        'arguments' => ['target' => TestClassSecondWithTestAttribute::class],
        'expectedValue' => ['testFirstProperty', 'testSecondProperty'],
        'testMethodThrows' => false,
    ];

    yield 'Failure class invalid' => [
        'arguments' => ['target' => 'NotValidClass'],
        'expectedValue' => [],
        'testMethodThrows' => true,
    ];
});
