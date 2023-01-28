<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Subnet\Service\Downloader\Serializer;

use Fp\Collections\ArrayList;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use UnBlockerService\Subnet\Domain\Service\Downloader\Serializer\SerializerInterface;
use UnBlockerService\Subnet\Domain\Service\Downloader\Serializer\ValueObject\Subnet;

#[AsService]
final class ListSerializer implements SerializerInterface
{
    private const SUBNET_REGEX = '/^(([12]?[0-9]{1,2}|2[0-4][0-9]|25[0-5])(\.|\/)){4}([1-2]?[0-9]|3[0-2])$/';

    public function deserialize(string $content, string $country): array
    {
        return ArrayList::collect(explode(\PHP_EOL, $content) ?: [])
            ->filter(static fn (string $subnet) => !empty($subnet))
            ->filter(static fn (string $subnet) => (bool) preg_match(self::SUBNET_REGEX, $subnet))
            ->map(static fn (string $subnet) => Subnet::fromSubnet($subnet, $country))
            ->toArray()
        ;
    }
}
