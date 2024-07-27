<?php

declare(strict_types=1);

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 *
 * Copyright (c) 2024 Mykhailo Shtanko fractalzombie@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE.MD
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Domain\Subnet\Service\Downloader\Request;

use UnBlockerService\Domain\Common\ValueObject\Provider;

final readonly class Request
{
    public function __construct(
        public string $url,
        public string $country,
    ) {}

    public static function fromProvider(Provider $provider): self
    {
        return new self($provider->url, $provider->country);
    }
}
