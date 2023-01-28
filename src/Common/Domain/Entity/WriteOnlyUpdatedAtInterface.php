<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Domain\Entity;

interface WriteOnlyUpdatedAtInterface
{
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self;
}
