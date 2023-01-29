<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Router\Service\Manager\Mikrotik\Response;

use Illuminate\Support\Arr;
use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Domain\Router\Service\Manager\Response\AddResponseInterface;

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

    public static function fromResponse(array $response): self
    {
        return new self(Arr::get($response, 'after.ret'));
    }
}
