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
