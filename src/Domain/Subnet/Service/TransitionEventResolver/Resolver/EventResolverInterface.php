<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Resolver;

use UnBlockerService\Domain\Subnet\Message\EventMessage;

/**
 * @method void __invoke(EventMessage $message)
 */
interface EventResolverInterface
{
    public function canResolve(EventMessage $message): bool;
}
