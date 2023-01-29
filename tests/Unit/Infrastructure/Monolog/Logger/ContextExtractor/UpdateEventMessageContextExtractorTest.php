<?php

declare(strict_types=1);

namespace UnBlockerService\Tests\Unit\Infrastructure\Monolog\Logger\ContextExtractor;

use UnBlockerService\Domain\Common\Service\Manipulator\ClassManipulatorInterface;
use UnBlockerService\Domain\Common\Service\Manipulator\ClockManipulatorInterface;
use UnBlockerService\Infrastructure\Monolog\Logger\ContextExtractor\Extractor\UpdateEventMessageContextExtractor;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\UpdateEventMessage;
use UnBlockerService\Tests\Helper\TestHelper;

test('It extract context from UpdateEventMessage', function (UpdateEventMessage $eventMessage, string $message, string $clockFormat, array $expectedContext, bool $isExtractable, ?\Throwable $exception = null): void {
    $classManipulator = $this->createMock(ClassManipulatorInterface::class);
    $clockManipulator = $this->createMock(ClockManipulatorInterface::class);
    $contextExtractor = new UpdateEventMessageContextExtractor($classManipulator, $clockManipulator);

    $classManipulator
        ->expects($exception ? $this->once() : $this->never())
        ->method('getShortName')
        ->willReturn('LogicException')
    ;

    $clockManipulator
        ->expects($this->exactly(2))
        ->method('defaultFormat')
        ->willReturn($clockFormat)
    ;

    $context = $contextExtractor->extract($eventMessage, $exception);

    expect($context->getContext())->toBe($expectedContext)
        ->and($context->getMessage())->toBe($message)
    ;
})->with(function () {
    $target = TestHelper::makeUpdateEventMessage();
    $exception = new \LogicException(TestHelper::MESSAGE);
    $clockFormat = \DateTimeInterface::RFC3339;

    yield 'Correct UpdateEventMessage Message' => [
        'target' => $target,
        'message' => '[HANDLER] [INFO] [MESSAGE: UpdateEventMessage] [MESSAGE_ID: {message_id}] [EXTERNAL_ID: {external_id}] [COUNTRY: {country}] [STATE: {state}] [SUBNET: {subnet}] [GROUP_NAME: {group_name}]',
        'clockFormat' => $clockFormat,
        'expectedContext' => [
            'message_id' => (string) $target->id,
            'external_id' => $target->externalId,
            'country' => $target->country,
            'subnet' => "{$target->address}/{$target->mask}",
            'event_type' => $target->eventType->value,
            'state' => $target->state->value,
            'created_at' => $target->createdAt->format($clockFormat),
            'updated_at' => $target->updatedAt->format($clockFormat),
        ],
        'isExtractable' => true,
        'exception' => null,
    ];

    yield 'Correct UpdateEventMessage Message with Exception' => [
        'target' => $target,
        'message' => '[HANDLER] [ERROR] [MESSAGE: UpdateEventMessage] [MESSAGE_ID: {message_id}] [EXTERNAL_ID: {external_id}] [EXCEPTION_CLASS: {exception_class}] [EXCEPTION_MESSAGE: {exception_message}] [COUNTRY: {country}] [STATE: {state}] [SUBNET: {subnet}] [GROUP_NAME: {group_name}]',
        'clockFormat' => $clockFormat,
        'expectedContext' => [
            'message_id' => (string) $target->id,
            'external_id' => $target->externalId,
            'country' => $target->country,
            'subnet' => "{$target->address}/{$target->mask}",
            'event_type' => $target->eventType->value,
            'state' => $target->state->value,
            'created_at' => $target->createdAt->format($clockFormat),
            'updated_at' => $target->updatedAt->format($clockFormat),
            'exception_class' => 'LogicException',
            'exception_message' => $exception->getMessage(),
            'exception_trace' => $exception->getTraceAsString(),
        ],
        'isExtractable' => true,
        'exception' => $exception,
    ];
});

test('It can extract context from UpdateEventMessage', function (object $eventMessage, bool $isExtractable): void {
    $classManipulator = $this->createMock(ClassManipulatorInterface::class);
    $clockManipulator = $this->createMock(ClockManipulatorInterface::class);
    $contextExtractor = new UpdateEventMessageContextExtractor($classManipulator, $clockManipulator);

    $canExtract = $contextExtractor->canExtract($eventMessage);

    expect($canExtract)->toBe($isExtractable);
})->with(function () {
    yield 'Correct UpdateEventMessage Message' => [
        'target' => TestHelper::makeUpdateEventMessage(),
        'isExtractable' => true,
    ];

    yield 'Correct UpdateEventMessage Message with Exception' => [
        'target' => TestHelper::makeObject(\stdClass::class),
        'isExtractable' => false,
    ];
});
