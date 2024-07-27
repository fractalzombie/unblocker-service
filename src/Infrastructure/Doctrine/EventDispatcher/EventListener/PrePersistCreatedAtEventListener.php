<?php

declare(strict_types=1);

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 *
 * Copyright (c) 2024 Mykhailo Shtanko fractalzombie@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE.MD
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Infrastructure\Doctrine\EventDispatcher\EventListener;

use Doctrine\ORM\Event\PrePersistEventArgs;
use Doctrine\ORM\Events;
use Psr\Clock\ClockInterface;
use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use UnBlockerService\Domain\Common\Entity\ReadOnlyCreatedAtInterface;

#[AsEventListener(Events::prePersist)]
readonly class PrePersistCreatedAtEventListener
{
    public function __construct(
        private ClockInterface $clock,
    ) {}

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
            && $object->isNotCreatedAt();
    }
}
