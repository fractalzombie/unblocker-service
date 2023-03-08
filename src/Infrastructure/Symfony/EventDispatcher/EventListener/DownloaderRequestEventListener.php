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

namespace UnBlockerService\Infrastructure\Symfony\EventDispatcher\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use UnBlockerService\Domain\Common\Enum\ProcessState;
use UnBlockerService\Domain\Subnet\Logger\DownloaderLoggerInterface;
use UnBlockerService\Infrastructure\Symfony\EventDispatcher\Event\DownloaderRequestEvent;

#[AsEventListener(DownloaderRequestEvent::class)]
final class DownloaderRequestEventListener
{
    public function __construct(
        private readonly DownloaderLoggerInterface $logger,
    ) {
    }

    public function __invoke(DownloaderRequestEvent $event): void
    {
        match ($event->processState) {
            ProcessState::Success => $this->logger->info($event->request, $event->response, $event->statusCode),
            ProcessState::Failure => $this->logger->error($event->request, $event->response, $event->statusCode, $event->exception),
        };
    }
}
