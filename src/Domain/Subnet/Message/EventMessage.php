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

namespace UnBlockerService\Domain\Subnet\Message;

use FRZB\Component\TransactionalMessenger\Attribute\Transactional;
use Symfony\Component\Serializer\Annotation\DiscriminatorMap;
use UnBlockerService\Domain\Subnet\Enum\EventType;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\AddEventMessage;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\CreateEventMessage;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\NotifyEventMessage;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\UpdateEventMessage;

#[Transactional]
#[DiscriminatorMap(self::TYPE_PROPERTY, self::DISCRIMINATOR_MAP)]
abstract readonly class EventMessage
{
    final public const TYPE_PROPERTY = 'eventType';

    final public const DISCRIMINATOR_MAP = [
        EventType::CREATE => CreateEventMessage::class,
        EventType::UPDATE => UpdateEventMessage::class,
        EventType::ADD => AddEventMessage::class,
        EventType::NOTIFY => NotifyEventMessage::class,
    ];

    public function __construct(
        public EventType $eventType,
    ) {}
}
