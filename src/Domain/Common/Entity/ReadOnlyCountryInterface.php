<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Entity;

interface ReadOnlyCountryInterface
{
    public function getCountry(): string;
}
