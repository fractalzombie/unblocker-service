<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Service\TransitionEventResolver;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Domain\Subnet\Service\TransitionEventResolver\Exception\EventMessageResolverException;
use UnBlockerService\Infrastructure\Subnet\Service\EventMessageResolver\EventMessageResolver;

#[AsAlias(EventMessageResolver::class)]
interface EventMessageResolverInterface
{
    /** @throws EventMessageResolverException */
    public function resolve(EventMessage $message): void;
}
