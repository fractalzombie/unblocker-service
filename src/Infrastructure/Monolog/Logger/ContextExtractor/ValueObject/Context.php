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

namespace UnBlockerService\Infrastructure\Monolog\Logger\ContextExtractor\ValueObject;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\ValueObject\ContextInterface;

#[Immutable]
final readonly class Context implements ContextInterface
{
    public function __construct(
        private string $message,
        private array $context,
    ) {}

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
