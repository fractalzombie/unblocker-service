<?php

declare(strict_types=1);

namespace UnBlockerService\Router\Infrastructure\Router\Service\Manipulator\Mikrotik\Response;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Router\Domain\Service\Manipulator\Response\AddResponseInterface;

#[Immutable]
final readonly class AddResponse implements AddResponseInterface
{
    public function __construct(
        private string $id,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public static function fromResponse(string $response): self
    {
        return new self($response);
    }
}
