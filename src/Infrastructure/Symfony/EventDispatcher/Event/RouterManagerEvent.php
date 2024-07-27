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

namespace UnBlockerService\Infrastructure\Symfony\EventDispatcher\Event;

use Symfony\Contracts\EventDispatcher\Event;
use UnBlockerService\Domain\Common\Enum\ProcessState;
use UnBlockerService\Domain\Subnet\Entity\ReadOnlySubnetInterface;

final class RouterManagerEvent extends Event
{
    public function __construct(
        public readonly ProcessState $processState,
        public readonly ReadOnlySubnetInterface $subnet,
        public readonly ?\Throwable $exception,
    ) {}
}
