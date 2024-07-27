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

namespace UnBlockerService\Infrastructure\Monolog\Logger;

use Psr\Log\LoggerInterface;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Contracts\HttpClient\ResponseInterface;
use UnBlockerService\Domain\Common\Enum\StatusCode;
use UnBlockerService\Domain\Subnet\Logger\DownloaderLoggerInterface;
use UnBlockerService\Domain\Subnet\Service\Downloader\Request\Request;
use UnBlockerService\Infrastructure\Common\Helper\HeaderHelper;

#[Autoconfigure]
class DownloaderLogger implements DownloaderLoggerInterface
{
    private const string MT_INFO = '[DOWNLOADER] [INFO] [URL: {url}] [COUNTRY: {country}] [STATUS_CODE: {status_code}] [HEADERS: {headers}]';
    private const string MT_ERROR = '[DOWNLOADER] [ERROR] [EXCEPTION_CLASS: {exception_class}] [EXCEPTION_MESSAGE: {exception_message}] [URL: {url}] [COUNTRY: {country}] [STATUS_CODE: {status_code}] [HEADERS: {headers}]';

    public function __construct(
        private readonly LoggerInterface $downloaderLogger,
    ) {}

    public function info(Request $request, ResponseInterface $response, StatusCode $statusCode): void
    {
        $context = [
            'url' => $request->url,
            'country' => $request->country,
            'status_code' => $statusCode->value,
            'headers' => HeaderHelper::fromResponse($response),
        ];

        $this->downloaderLogger->info(self::MT_INFO, $context);
    }

    public function error(Request $request, ResponseInterface $response, StatusCode $statusCode, \Throwable $exception): void
    {
        $context = [
            'url' => $request->url,
            'country' => $request->country,
            'status_code' => $statusCode->value,
            'headers' => HeaderHelper::fromResponse($response),
            'exception_class' => $exception::class,
            'exception_message' => $exception->getMessage(),
        ];

        $this->downloaderLogger->error(self::MT_ERROR, $context);
    }
}
