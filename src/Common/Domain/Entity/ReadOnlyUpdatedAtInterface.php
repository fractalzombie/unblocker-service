<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Domain\Entity;

interface ReadOnlyUpdatedAtInterface
{
    public function getUpdatedAt(): \DateTimeInterface;
}
