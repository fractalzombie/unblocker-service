<?php

declare(strict_types=1);

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 *
 * Copyright (c) 2024 Mykhailo Shtanko fractalzombie@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE.MD
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Infrastructure\Monolog\Logger\ContextExtractor;

use Fp\Collections\ArrayList;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\ContextExtractorLocatorInterface;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\Extractor\ContextExtractorInterface;

#[Autoconfigure]
class ContextExtractorLocator implements ContextExtractorLocatorInterface
{
    private readonly ArrayList $factories;

    public function __construct(
        #[AutowireIterator(ContextExtractorInterface::class, defaultPriorityMethod: 'getPriority')]
        iterable $factories,
    ) {
        $this->factories = ArrayList::collect($factories);
    }

    public function get(object $message): ContextExtractorInterface
    {
        return $this->factories
            ->first(static fn (ContextExtractorInterface $contextExtractor) => $contextExtractor->canExtract($message))
            ->getUnsafe();
    }
}
