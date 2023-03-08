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
