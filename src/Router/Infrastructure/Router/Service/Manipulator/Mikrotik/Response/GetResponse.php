<?php

declare(strict_types=1);

namespace UnBlockerService\Router\Infrastructure\Router\Service\Manipulator\Mikrotik\Response;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Router\Domain\Service\Manipulator\Response\GetResponseInterface;

#[Immutable]
final readonly class GetResponse implements GetResponseInterface
{
    public function __construct(
        private string $id,
        private string $address,
        private \DateTimeImmutable $createdAt,
        private bool $isDisabled,
        private string $groupName,
    ) {
    }

    public static function fromResponse(string $response): self
    {
        $exploded = explode(';', $response);
        $attributes = [];

        foreach ($exploded as $item) {
            [$key, $value] = explode('=', $item);
            $attributes[$key] = $value;
        }

        return new self(
            $attributes['.id'],
            $attributes['address'],
            \DateTimeImmutable::createFromFormat('M/d/Y H:i:s', $attributes['creation-time']),
            (bool) $attributes['dynamic'],
            $attributes['list'],
        );
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getAddress(): string
    {
        return $this->address;
    }

    public function getCreatedAt(): \DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function isDisabled(): bool
    {
        return $this->isDisabled;
    }

    public function getGroupName(): string
    {
        return $this->groupName;
    }
}
