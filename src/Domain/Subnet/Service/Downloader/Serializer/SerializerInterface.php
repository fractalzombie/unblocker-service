<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Service\Downloader\Serializer;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Domain\Subnet\Service\Downloader\Exception\SerializerException;
use UnBlockerService\Domain\Subnet\Service\Downloader\Serializer\ValueObject\Subnet;
use UnBlockerService\Infrastructure\Subnet\Service\Downloader\Serializer\ListSerializer;

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
