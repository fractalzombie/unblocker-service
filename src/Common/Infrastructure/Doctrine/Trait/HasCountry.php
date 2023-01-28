<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Infrastructure\Doctrine\Trait;

use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

trait HasCountry
{
    private const MAX_LENGTH_OF_COUNTRY = 64;

    #[ORM\Column(type: Types::STRING, length: self::MAX_LENGTH_OF_COUNTRY)]
    private string $country;

    public function getCountry(): string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }
}
