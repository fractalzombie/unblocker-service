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

namespace UnBlockerService\Domain\Subnet\Service\Downloader;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Domain\Subnet\Service\Downloader\Exception\DownloaderException;
use UnBlockerService\Domain\Subnet\Service\Downloader\Request\Request;
use UnBlockerService\Domain\Subnet\Service\Downloader\Serializer\ValueObject\Subnet;
use UnBlockerService\Infrastructure\Subnet\Service\Downloader\HttpDownloader;

#[AsAlias(HttpDownloader::class)]
interface DownloaderInterface
{
    /**
     * @return Subnet[]
     *
     * @throws DownloaderException
     */
    public function download(Request $request): array;
}
