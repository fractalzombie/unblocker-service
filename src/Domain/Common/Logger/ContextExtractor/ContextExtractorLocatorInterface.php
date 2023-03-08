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

namespace UnBlockerService\Domain\Common\Logger\ContextExtractor;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\Extractor\ContextExtractorInterface;
use UnBlockerService\Infrastructure\Monolog\Logger\ContextExtractor\ContextExtractorLocator;

#[AsAlias(ContextExtractorLocator::class)]
interface ContextExtractorLocatorInterface
{
    public function get(object $message): ContextExtractorInterface;
}
