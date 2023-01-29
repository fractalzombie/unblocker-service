<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Service\Downloader\Request;

use UnBlockerService\Domain\Common\ValueObject\Provider;

final readonly class Request
{
    public function __construct(
        public string $url,
        public string $country,
    ) {
    }

    public static function fromProvider(Provider $provider): self
    {
        return new self($provider->url, $provider->country);
    }
}
