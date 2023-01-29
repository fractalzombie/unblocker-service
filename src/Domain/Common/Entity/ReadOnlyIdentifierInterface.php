<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Entity;

use Symfony\Component\Uid\Uuid;

interface ReadOnlyIdentifierInterface
{
    public function getId(): Uuid;
}
