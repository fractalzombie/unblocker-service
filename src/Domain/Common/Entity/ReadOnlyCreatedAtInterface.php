<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Entity;

interface ReadOnlyCreatedAtInterface
{
    public function getCreatedAt(): \DateTimeInterface;

    public function isNotCreatedAt(): bool;
}
