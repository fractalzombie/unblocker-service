<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Doctrine\EventDispatcher\EventListener;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Psr\Clock\ClockInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use UnBlockerService\Domain\Common\Entity\WriteOnlyUpdatedAtInterface;

#[AsEventListener(Events::prePersist)]
class PrePersistUpdatedAtEventListener
{
    public function __construct(
        private readonly ClockInterface $clock,
    ) {
    }

    public function __invoke(PrePersistEventArgs $event): void
    {
        $object = $event->getObject();

        if ($object instanceof WriteOnlyUpdatedAtInterface) {
            $object->setUpdatedAt($this->clock->now());
        }
    }
}
