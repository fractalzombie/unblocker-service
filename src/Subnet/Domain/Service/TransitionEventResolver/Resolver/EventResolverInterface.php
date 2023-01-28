<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Service\TransitionEventResolver\Resolver;

use UnBlockerService\Subnet\Domain\Message\EventMessage;

/**
 * @method void __invoke(EventMessage $message)
 */
interface EventResolverInterface
{
    public function canResolve(EventMessage $message): bool;
}
