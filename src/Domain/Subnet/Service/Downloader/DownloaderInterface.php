<?php

declare(strict_types=1);

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
