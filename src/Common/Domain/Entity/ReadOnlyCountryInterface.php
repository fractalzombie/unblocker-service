<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Domain\Entity;

interface ReadOnlyCountryInterface
{
    public function getCountry(): string;
}
