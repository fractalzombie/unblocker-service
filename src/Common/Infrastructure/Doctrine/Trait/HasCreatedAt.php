<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Infrastructure\Doctrine\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait HasCreatedAt
{
    #[ORM\Column(type: Types::DATETIMETZ_IMMUTABLE, updatable: false)]
    private \DateTimeInterface $createdAt;

    public function getCreatedAt(): \DateTimeInterface
    {
        return $this->createdAt;
    }

    public function isNotCreatedAt(): bool
    {
        return !isset($this->createdAt);
    }

    public function setCreatedAt(\DateTimeInterface $createdAt): self
    {
        $this->createdAt = $createdAt;

        return $this;
    }
}
