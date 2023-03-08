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

namespace UnBlockerService\Infrastructure\Monolog\Logger\ContextExtractor\ValueObject;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\ValueObject\ContextInterface;

#[Immutable]
final readonly class Context implements ContextInterface
{
    public function __construct(
        private string $message,
        private array $context,
    ) {
    }

    public function getMessage(): string
    {
        return $this->message;
    }

    public function getContext(): array
    {
        return $this->context;
    }
}
