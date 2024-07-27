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

namespace UnBlockerService\Domain\Subnet\Logger;

use Symfony\Contracts\HttpClient\ResponseInterface;
use UnBlockerService\Domain\Common\Enum\StatusCode;
use UnBlockerService\Domain\Subnet\Service\Downloader\Request\Request;

interface DownloaderLoggerInterface
{
    public function info(Request $request, ResponseInterface $response, StatusCode $statusCode): void;

    public function error(Request $request, ResponseInterface $response, StatusCode $statusCode, \Throwable $exception): void;
}
