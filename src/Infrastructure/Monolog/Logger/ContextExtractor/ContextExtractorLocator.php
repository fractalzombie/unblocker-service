<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Monolog\Logger\ContextExtractor;

use Fp\Collections\ArrayList;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\ContextExtractorLocatorInterface;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\Extractor\ContextExtractorInterface;

#[AsService]
class ContextExtractorLocator implements ContextExtractorLocatorInterface
{
    private readonly ArrayList $factories;

    public function __construct(
        #[TaggedIterator(ContextExtractorInterface::class, defaultPriorityMethod: 'getPriority')]
        iterable $factories,
    ) {
        $this->factories = ArrayList::collect($factories);
    }

    public function get(object $message): ContextExtractorInterface
    {
        return $this->factories
            ->first(static fn (ContextExtractorInterface $contextExtractor) => $contextExtractor->canExtract($message))
            ->getUnsafe()
        ;
    }
}
