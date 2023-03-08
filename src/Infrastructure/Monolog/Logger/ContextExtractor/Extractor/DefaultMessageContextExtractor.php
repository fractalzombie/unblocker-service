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

namespace UnBlockerService\Infrastructure\Monolog\Logger\ContextExtractor\Extractor;

use FRZB\Component\DependencyInjection\Attribute\AsService;
use FRZB\Component\DependencyInjection\Attribute\AsTagged;
use Symfony\Component\Serializer\Normalizer\NormalizerInterface;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\Extractor\ContextExtractorInterface;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\ValueObject\ContextInterface;
use UnBlockerService\Domain\Common\Service\Manipulator\ClassManipulatorInterface;
use UnBlockerService\Infrastructure\Monolog\Logger\ContextExtractor\ValueObject\Context;

#[AsService, AsTagged(ContextExtractorInterface::class)]
class DefaultMessageContextExtractor implements ContextExtractorInterface
{
    private const MT_INFO = '[HANDLER] [INFO] [MESSAGE: {message_class}] [MESSAGE_ID: {message_id}]';
    private const MT_ERROR = '[HANDLER] [ERROR] [MESSAGE: {message_class}] [MESSAGE_ID: {message_id}] [EXCEPTION_CLASS: {exception_class}] [EXCEPTION_MESSAGE: {exception_message}]';

    public function __construct(
        private readonly NormalizerInterface $normalizer,
        private readonly ClassManipulatorInterface $classManipulator,
    ) {
    }

    public function extract(object $context, ?\Throwable $exception = null): ContextInterface
    {
        $context = [
            ...$this->normalizer->normalize($context, 'array'),
            'message_id' => spl_object_id($context),
            'message_class' => $this->classManipulator->getShortName($context),
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
        return true;
    }

    public static function getPriority(): int
    {
        return 0;
    }
}
