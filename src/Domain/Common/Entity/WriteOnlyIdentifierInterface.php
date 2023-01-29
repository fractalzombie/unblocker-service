<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Entity;

use Symfony\Component\Uid\Uuid;

interface WriteOnlyIdentifierInterface
{
    public function setId(Uuid $id): self;
}
