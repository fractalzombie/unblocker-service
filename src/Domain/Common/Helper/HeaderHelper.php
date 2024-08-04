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

namespace UnBlockerService\Domain\Common\Helper;

use JetBrains\PhpStorm\Immutable;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Contracts\HttpClient\ResponseInterface;
use UnBlockerService\Infrastructure\Doctrine\Trait\PrivateConstructorTrait;

#[Immutable]
final class HeaderHelper
{
    use PrivateConstructorTrait;

    public static function all(array|HeaderBag $headers): array
    {
        $headers = \is_array($headers) ? new HeaderBag($headers) : $headers;

        return array_map(static fn (array $value) => current($value) ?: null, $headers->all());
    }

    public static function fromResponse(ResponseInterface $response): array
    {
        try {
            return self::all($response->getHeaders(false));
        } catch (\Throwable) {
            return [];
        }
    }
}
