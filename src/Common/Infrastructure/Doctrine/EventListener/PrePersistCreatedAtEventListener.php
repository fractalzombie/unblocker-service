<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Infrastructure\Doctrine\EventListener;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use UnBlockerService\Common\Domain\Entity\ReadOnlyCreatedAtInterface;
use UnBlockerService\Common\Domain\Entity\WriteOnlyCreatedAtInterface;

#[AsEventListener(Events::prePersist)]
class PrePersistCreatedAtEventListener
{
    public function __invoke(PrePersistEventArgs $event): void
    {
        $object = $event->getObject();

        if ($object instanceof WriteOnlyCreatedAtInterface && $object instanceof ReadOnlyCreatedAtInterface && $object->isNotCreatedAt()) {
            $object->setCreatedAt(new \DateTimeImmutable());
        }
    }
}
