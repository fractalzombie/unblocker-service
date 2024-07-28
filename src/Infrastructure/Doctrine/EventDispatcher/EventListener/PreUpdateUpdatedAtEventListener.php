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

use Doctrine\Bundle\DoctrineBundle\Attribute\AsEntityListener;
use Doctrine\ORM\Event\PreUpdateEventArgs;
use Doctrine\ORM\Events;
use Psr\Clock\ClockInterface;
use UnBlockerService\Domain\Common\Entity\UpdatedAtInterface;
use UnBlockerService\Infrastructure\Doctrine\Entity\Subnet;

#[AsEntityListener(Events::preUpdate, entity: Subnet::class)]
final readonly class PreUpdateUpdatedAtEventListener
{
    public function __construct(
        private ClockInterface $clock,
    ) {}

    public function __invoke(UpdatedAtInterface $target, PreUpdateEventArgs $event): void
    {
        $target->setUpdatedAt($this->clock->now());
    }
}
