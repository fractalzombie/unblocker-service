<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Monolog\Logger\ContextExtractor\Extractor;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use FRZB\Component\DependencyInjection\Attribute\AsTagged;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\Extractor\ContextExtractorInterface;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\ValueObject\ContextInterface;
use UnBlockerService\Domain\Common\Service\Manipulator\ClassManipulatorInterface;
use UnBlockerService\Infrastructure\Monolog\Logger\ContextExtractor\ValueObject\Context;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\NotifyEventMessage;

#[AsService, AsTagged(ContextExtractorInterface::class)]
class NotifyEventMessageContextExtractor implements ContextExtractorInterface
{
    private const MT_INFO = '[HANDLER] [INFO] [MESSAGE: NotifyEventMessage] [MESSAGE_ID: {message_id}] [COUNTRY: {country}]';
    private const MT_ERROR = '[HANDLER] [ERROR] [MESSAGE: NotifyEventMessage] [MESSAGE_ID: {message_id}] [EXCEPTION_CLASS: {exception_class}] [EXCEPTION_MESSAGE: {exception_message}]';

    public function __construct(
        private readonly ClassManipulatorInterface $classManipulator,
    ) {
    }

    public function extract(NotifyEventMessage $context, ?\Throwable $exception = null): ContextInterface
    {
        $context = [
            'message_id' => spl_object_id($context),
            'event_type' => $context->eventType->value,
            'message' => $context->message,
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
        return $context instanceof NotifyEventMessage;
    }

    public static function getPriority(): int
    {
        return 4;
    }
}
