<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Entity;

interface ReadOnlyUpdatedAtInterface
{
    public function getUpdatedAt(): \DateTimeInterface;
}
