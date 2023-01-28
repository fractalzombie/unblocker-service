<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Publisher;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Subnet\Domain\Message\EventMessage;
use UnBlockerService\Subnet\Infrastructure\Symfony\Messenger\Publisher\EventPublisher;

#[AsAlias(EventPublisher::class)]
interface EventPublisherInterface
{
    public function publish(EventMessage $message): void;
}
