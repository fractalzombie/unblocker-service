<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Infrastructure\Doctrine\EventListener;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use UnBlockerService\Common\Domain\Entity\WriteOnlyUpdatedAtInterface;

#[AsEventListener(Events::prePersist)]
class PrePersistUpdatedAtEventListener
{
    public function __invoke(PrePersistEventArgs $event): void
    {
        $object = $event->getObject();

        if ($object instanceof WriteOnlyUpdatedAtInterface) {
            $object->setUpdatedAt(new \DateTimeImmutable());
        }
    }
}
