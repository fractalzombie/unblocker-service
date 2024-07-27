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

namespace UnBlockerService\Infrastructure\Subnet\Service\Downloader\Serializer;

use Fp\Collections\ArrayList;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use UnBlockerService\Domain\Subnet\Service\Downloader\Serializer\SerializerInterface;
use UnBlockerService\Domain\Subnet\Service\Downloader\Serializer\ValueObject\Subnet;

#[Autoconfigure]
final class ListSerializer implements SerializerInterface
{
    private const string SUBNET_REGEX = '/^(([12]?[0-9]{1,2}|2[0-4][0-9]|25[0-5])(\.|\/)){4}([1-2]?[0-9]|3[0-2])$/';

    public function deserialize(string $content, string $country): array
    {
        return ArrayList::collect(explode(\PHP_EOL, $content) ?: [])
            ->filter(static fn (string $subnet) => !empty($subnet))
            ->filter(static fn (string $subnet) => (bool) preg_match(self::SUBNET_REGEX, $subnet))
            ->map(static fn (string $subnet) => Subnet::fromSubnet($subnet, $country))
            ->toList();
    }
}
