<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Domain\Entity;

interface WriteOnlyCountryInterface
{
    public function setCountry(string $country): self;
}
