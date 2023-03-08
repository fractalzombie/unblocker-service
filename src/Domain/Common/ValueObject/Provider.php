<?php

declare(strict_types=1);

/*
 * UnBlocker service for routers.
 *
 * (c) Mykhailo Shtanko <fractalzombie@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

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
