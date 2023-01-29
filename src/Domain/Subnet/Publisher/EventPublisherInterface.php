<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Publisher;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Infrastructure\Symfony\Messenger\Publisher\EventPublisher;

#[AsAlias(EventPublisher::class)]
interface EventPublisherInterface
{
    public function publish(EventMessage $message): void;
}
