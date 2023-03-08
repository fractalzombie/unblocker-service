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

namespace UnBlockerService\Infrastructure\Subnet\Service\EventMessageResolver;

use Fp\Collections\ArrayList;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use Symfony\Component\DependencyInjection\Attribute\TaggedIterator;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\EventMessageResolverInterface;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Exception\EventMessageResolverException;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Resolver\EventResolverInterface as EventResolver;

#[AsService]
final readonly class EventMessageResolver implements EventMessageResolverInterface
{
    /** @var ArrayList<EventResolver> */
    private readonly ArrayList $resolvers;

    public function __construct(
        #[TaggedIterator(EventResolver::class)] iterable $resolvers,
    ) {
        $this->resolvers = ArrayList::collect($resolvers);
    }

    public function resolve(EventMessage $message): void
    {
        try {
            $this->resolvers
                ->filter(static fn (EventResolver $resolver) => $resolver->canResolve($message))
                ->tap(static fn (EventResolver $resolver) => $resolver($message))
            ;
        } catch (\Throwable $e) {
            throw EventMessageResolverException::fromThrowable($e);
        }
    }
}
