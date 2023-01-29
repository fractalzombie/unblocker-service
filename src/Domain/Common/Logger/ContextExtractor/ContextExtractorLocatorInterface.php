<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Logger\ContextExtractor;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\Extractor\ContextExtractorInterface;
use UnBlockerService\Infrastructure\Monolog\Logger\ContextExtractor\ContextExtractorLocator;

#[AsAlias(ContextExtractorLocator::class)]
interface ContextExtractorLocatorInterface
{
    public function get(object $message): ContextExtractorInterface;
}
