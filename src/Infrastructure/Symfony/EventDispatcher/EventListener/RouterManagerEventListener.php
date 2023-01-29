<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Symfony\EventDispatcher\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use UnBlockerService\Domain\Common\Enum\ProcessState;
use UnBlockerService\Domain\Router\Logger\RouterManagerLoggerInterface;
use UnBlockerService\Infrastructure\Symfony\EventDispatcher\Event\RouterManagerEvent;

#[AsEventListener(RouterManagerEvent::class)]
final readonly class RouterManagerEventListener
{
    public function __construct(
        private RouterManagerLoggerInterface $logger,
    ) {
    }

    public function __invoke(RouterManagerEvent $event): void
    {
        match ($event->processState) {
            ProcessState::Success => $this->logger->info($event->subnet),
            ProcessState::Failure => $this->logger->error($event->subnet, $event->exception),
        };
    }
}
