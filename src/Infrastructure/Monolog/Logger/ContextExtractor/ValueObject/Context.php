<?php

declare(strict_types=1);

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
