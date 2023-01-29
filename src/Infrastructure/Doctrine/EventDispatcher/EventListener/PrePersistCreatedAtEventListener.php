<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Doctrine\EventDispatcher\EventListener;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Psr\Clock\ClockInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use UnBlockerService\Domain\Common\Entity\ReadOnlyCreatedAtInterface;

#[AsEventListener(Events::prePersist)]
class PrePersistCreatedAtEventListener
{
    public function __construct(
        private readonly ClockInterface $clock,
    ) {
    }

    public function __invoke(PrePersistEventArgs $event): void
    {
        $object = $event->getObject();

        if ($this->isNotCreated($object)) {
            $object->setCreatedAt($this->clock->now());
        }
    }

    private function isNotCreated(object $object): bool
    {
        return $object instanceof ReadOnlyCreatedAtInterface
            && $object->isNotCreatedAt()
        ;
    }
}
