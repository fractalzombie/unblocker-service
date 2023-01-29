<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Entity;

interface WriteOnlyCreatedAtInterface
{
    public function setCreatedAt(\DateTimeInterface $createdAt): self;
}
