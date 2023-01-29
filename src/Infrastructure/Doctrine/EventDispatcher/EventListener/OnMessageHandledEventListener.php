<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Doctrine\EventDispatcher\EventListener;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\Messenger\Event\WorkerMessageHandledEvent;
use UnBlockerService\Domain\Common\Logger\HandlerLoggerInterface;

#[AsEventListener(WorkerMessageHandledEvent::class)]
class OnMessageHandledEventListener
{
    public function __construct(
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function __invoke(WorkerMessageHandledEvent $event): void
    {
        $this->entityManager->flush();
    }
}
