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

namespace UnBlockerService\Domain\Subnet\Service\Downloader;

use UnBlockerService\Domain\Subnet\Service\Downloader\Exception\DownloaderException;
use UnBlockerService\Domain\Subnet\Service\Downloader\Request\Request;
use UnBlockerService\Domain\Subnet\Service\Downloader\Serializer\ValueObject\Subnet;

interface DownloaderInterface
{
    /**
     * @psalm-return Subnet[]
     *
     * @throws DownloaderException
     */
    public function download(Request $request): array;
}
