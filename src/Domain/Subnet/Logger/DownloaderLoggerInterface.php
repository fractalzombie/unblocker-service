<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Logger;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use Symfony\Contracts\HttpClient\ResponseInterface;
use UnBlockerService\Domain\Common\Enum\StatusCode;
use UnBlockerService\Domain\Subnet\Service\Downloader\Request\Request;
use UnBlockerService\Infrastructure\Monolog\Logger\DownloaderLogger;

#[AsAlias(DownloaderLogger::class)]
interface DownloaderLoggerInterface
{
    public function info(Request $request, ResponseInterface $response, StatusCode $statusCode): void;

    public function error(Request $request, ResponseInterface $response, StatusCode $statusCode, \Throwable $exception): void;
}
