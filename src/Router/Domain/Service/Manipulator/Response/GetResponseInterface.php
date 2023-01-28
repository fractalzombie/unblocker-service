<?php

declare(strict_types=1);

namespace UnBlockerService\Router\Domain\Service\Manipulator\Response;

interface GetResponseInterface
{
    public function getId(): string;

    public function getAddress(): string;

    public function getCreatedAt(): \DateTimeImmutable;

    public function isDisabled(): bool;

    public function getGroupName(): string;
}
