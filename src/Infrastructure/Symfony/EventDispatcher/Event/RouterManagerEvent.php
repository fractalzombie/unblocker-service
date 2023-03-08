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
    ) {
    }
}
