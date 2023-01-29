<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Logger\ContextExtractor\Extractor;

use UnBlockerService\Domain\Common\Logger\ContextExtractor\ValueObject\ContextInterface;

/**
 * @method ContextInterface extract(object $context, ?\Throwable $exception = null)
 */
interface ContextExtractorInterface
{
    public function canExtract(object $context): bool;

    public static function getPriority(): int;
}
