<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Router\Service\Manager\Response;

interface GetResponseInterface
{
    public function getId(): string;

    public function getAddress(): string;

    public function getCreatedAt(): \DateTimeImmutable;

    public function isDynamic(): bool;

    public function getGroupName(): string;
}
