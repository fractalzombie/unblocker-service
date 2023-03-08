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

namespace UnBlockerService\Domain\Subnet\Publisher;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Domain\Subnet\Message\EventMessage;
use UnBlockerService\Infrastructure\Symfony\Messenger\Publisher\EventPublisher;

#[AsAlias(EventPublisher::class)]
interface EventPublisherInterface
{
    public function publish(EventMessage $message): void;
}
