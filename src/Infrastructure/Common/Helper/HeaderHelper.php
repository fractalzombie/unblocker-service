<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Common\Helper;

use JetBrains\PhpStorm\Immutable;
use Symfony\Component\HttpFoundation\HeaderBag;
use Symfony\Contracts\HttpClient\ResponseInterface;
use UnBlockerService\Infrastructure\Doctrine\Trait\HasPrivateConstructor;

#[Immutable]
final class HeaderHelper
{
    use HasPrivateConstructor;

    public static function all(HeaderBag|array $headers): array
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
