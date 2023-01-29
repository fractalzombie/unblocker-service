<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Router\Service\Manager\Mikrotik\Response;

use Illuminate\Support\Arr;
use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Domain\Router\Service\Manager\Response\GetResponseInterface;

#[Immutable]
final readonly class GetResponse implements GetResponseInterface
{
    public function __construct(
        private string $id,
        private string $address,
        private \DateTimeImmutable $createdAt,
        private bool $isDynamic,
        private string $groupName,
    ) {
    }

    public static function fromResponse(array $response): self
    {
        $exploded = explode(';', Arr::get($response, 'after.ret'));
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

    public function isDynamic(): bool
    {
        return $this->isDynamic;
    }

    public function getGroupName(): string
    {
        return $this->groupName;
    }
}
