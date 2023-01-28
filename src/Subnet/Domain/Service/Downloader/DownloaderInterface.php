<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Service\Downloader;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Subnet\Domain\Service\Downloader\Exception\DownloaderException;
use UnBlockerService\Subnet\Domain\Service\Downloader\Request\Request;
use UnBlockerService\Subnet\Domain\Service\Downloader\Serializer\ValueObject\Subnet;
use UnBlockerService\Subnet\Infrastructure\Subnet\Service\Downloader\HttpDownloader;

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
