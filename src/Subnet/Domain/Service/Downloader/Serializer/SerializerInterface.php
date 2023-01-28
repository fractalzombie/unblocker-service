<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Service\Downloader\Serializer;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Subnet\Domain\Service\Downloader\Exception\SerializerException;
use UnBlockerService\Subnet\Domain\Service\Downloader\Serializer\ValueObject\Subnet;
use UnBlockerService\Subnet\Infrastructure\Subnet\Service\Downloader\Serializer\ListSerializer;

#[AsAlias(ListSerializer::class)]
interface SerializerInterface
{
    /**
     * @return Subnet[]
     *
     * @throws SerializerException
     */
    public function deserialize(string $content, string $country): array;
}
