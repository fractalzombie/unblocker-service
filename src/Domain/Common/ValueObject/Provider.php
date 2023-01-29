<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\ValueObject;

final readonly class Provider
{
    public string $url;
    public string $country;

    public function __construct(string $url, string $country)
    {
        $this->url = $url;
        $this->country = strtoupper($country);
    }

    public static function fromProvider(array $provider): self
    {
        return new self(...$provider);
    }
}
