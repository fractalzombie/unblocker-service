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

namespace UnBlockerService\Infrastructure\Symfony\Messenger\Handler;

use Symfony\Component\Messenger\Attribute\AsMessageHandler;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\EventMessageResolverInterface as TransitionEventResolver;

#[AsMessageHandler]
final readonly class EventMessageHandler
{
    public function __construct(
        private TransitionEventResolver $eventResolver,
    ) {
    }

    public function __invoke(EventMessage $message): void
    {
        $this->eventResolver->resolve($message);
    }
}
