<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Entity;

interface WriteOnlyUpdatedAtInterface
{
    public function setUpdatedAt(\DateTimeInterface $updatedAt): self;
}
