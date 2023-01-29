<?php

declare(strict_types=1);

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
