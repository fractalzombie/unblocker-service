<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Service\TransitionEventResolver;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Subnet\Domain\Message\EventMessage;
use UnBlockerService\Subnet\Domain\Service\TransitionEventResolver\Exception\EventMessageResolverException;
use UnBlockerService\Subnet\Infrastructure\Subnet\Service\EventMessageResolver\EventMessageResolver;

#[AsAlias(EventMessageResolver::class)]
interface EventMessageResolverInterface
{
    /** @throws EventMessageResolverException */
    public function resolve(EventMessage $message): void;
}
