<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Entity;

interface WriteOnlyCountryInterface
{
    public function setCountry(string $country): self;
}
