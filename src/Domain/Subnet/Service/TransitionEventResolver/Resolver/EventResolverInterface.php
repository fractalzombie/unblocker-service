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

namespace UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Resolver;

use UnBlockerService\Domain\Subnet\Message\EventMessage;

/**
 * @method void __invoke(EventMessage $message)
 */
interface EventResolverInterface
{
    public function canResolve(EventMessage $message): bool;
}
