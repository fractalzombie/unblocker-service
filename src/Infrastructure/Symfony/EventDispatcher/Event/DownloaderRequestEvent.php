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

namespace UnBlockerService\Infrastructure\Symfony\EventDispatcher\Event;

use Symfony\Contracts\EventDispatcher\Event;
use Symfony\Contracts\HttpClient\ResponseInterface;
use UnBlockerService\Domain\Common\Enum\ProcessState;
use UnBlockerService\Domain\Common\Enum\StatusCode;
use UnBlockerService\Domain\Subnet\Service\Downloader\Request\Request;

final class DownloaderRequestEvent extends Event
{
    public function __construct(
        public readonly ProcessState $processState,
        public readonly StatusCode $statusCode,
        public readonly Request $request,
        public readonly ?ResponseInterface $response,
        public readonly ?\Throwable $exception,
    ) {
    }
}
