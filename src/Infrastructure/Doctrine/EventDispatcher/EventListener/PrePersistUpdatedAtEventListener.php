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
