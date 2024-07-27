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

namespace UnBlockerService\Infrastructure\Subnet\Service\EventMessageResolver;

use Fp\Collections\ArrayList;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\Attribute\AutowireIterator;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\EventMessageResolverInterface;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Exception\EventMessageResolverException;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Resolver\EventResolverInterface as EventResolver;

#[Autoconfigure]
final readonly class EventMessageResolver implements EventMessageResolverInterface
{
    /** @var ArrayList<EventResolver> */
    private ArrayList $resolvers;

    public function __construct(
        #[AutowireIterator(EventResolver::class)]
        iterable $resolvers,
    ) {
        $this->resolvers = ArrayList::collect($resolvers);
    }

    public function resolve(EventMessage $message): void
    {
        try {
            $this->resolvers
                ->filter(static fn (EventResolver $resolver) => $resolver->canResolve($message))
                ->tap(static fn (EventResolver $resolver) => $resolver($message));
        } catch (\Throwable $e) {
            throw EventMessageResolverException::fromThrowable($e);
        }
    }
}
