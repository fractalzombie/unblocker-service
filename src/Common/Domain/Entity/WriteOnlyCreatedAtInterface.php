<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Domain\Entity;

interface WriteOnlyCreatedAtInterface
{
    public function setCreatedAt(\DateTimeInterface $createdAt): self;
}
