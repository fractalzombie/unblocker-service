<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Monolog\Logger\ContextExtractor\Extractor;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use FRZB\Component\DependencyInjection\Attribute\AsTagged;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\Extractor\ContextExtractorInterface;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\ValueObject\ContextInterface;
use UnBlockerService\Domain\Common\Service\Manipulator\ClassManipulatorInterface;
use UnBlockerService\Domain\Common\Service\Manipulator\ClockManipulatorInterface;
use UnBlockerService\Infrastructure\Monolog\Logger\ContextExtractor\ValueObject\Context;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\AddEventMessage;

#[AsService, AsTagged(ContextExtractorInterface::class)]
class AddEventMessageContextExtractor implements ContextExtractorInterface
{
    private const MT_INFO = '[HANDLER] [INFO] [MESSAGE: AddEventMessage] [MESSAGE_ID: {message_id}] [COUNTRY: {country}] [STATE: {state}] [SUBNET: {subnet}] [GROUP_NAME: {group_name}]';
    private const MT_ERROR = '[HANDLER] [ERROR] [MESSAGE: AddEventMessage] [MESSAGE_ID: {message_id}] [EXCEPTION_CLASS: {exception_class}] [EXCEPTION_MESSAGE: {exception_message}] [COUNTRY: {country}] [STATE: {state}] [SUBNET: {subnet}] [GROUP_NAME: {group_name}]';

    public function __construct(
        private readonly ClassManipulatorInterface $classManipulator,
        private readonly ClockManipulatorInterface $clockManipulator,
    ) {
    }

    public function extract(AddEventMessage $context, ?\Throwable $exception = null): ContextInterface
    {
        $context = [
            'message_id' => (string) $context->id,
            'country' => $context->country,
            'subnet' => "{$context->address}/{$context->mask}",
            'event_type' => $context->eventType->value,
            'state' => $context->state->value,
            'created_at' => $context->createdAt->format($this->clockManipulator->defaultFormat()),
            'updated_at' => $context->updatedAt->format($this->clockManipulator->defaultFormat()),
        ];

        if ($exception) {
            $context = [
                ...$context,
                'exception_class' => $this->classManipulator->getShortName($exception),
                'exception_message' => $exception->getMessage(),
                'exception_trace' => $exception->getTraceAsString(),
            ];
        }

        return new Context($exception ? self::MT_ERROR : self::MT_INFO, $context);
    }

    public function canExtract(object $context): bool
    {
        return $context instanceof AddEventMessage;
    }

    public static function getPriority(): int
    {
        return 1;
    }
}
