<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Domain\Entity;

interface ReadOnlyCreatedAtInterface
{
    public function getCreatedAt(): \DateTimeInterface;

    public function isNotCreatedAt(): bool;
}
