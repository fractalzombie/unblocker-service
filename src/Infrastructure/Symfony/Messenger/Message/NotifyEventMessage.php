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

namespace UnBlockerService\Infrastructure\Symfony\Messenger\Message;

use UnBlockerService\Domain\Subnet\Enum\EventType;
use UnBlockerService\Domain\Subnet\Message\EventMessage;

final readonly class NotifyEventMessage extends EventMessage
{
    private const MESSAGE_TEMPLATE = 'Executed at %s: %s';

    public function __construct(
        public string $message,
        EventType $eventType,
    ) {
        parent::__construct($eventType);
    }

    public static function fromMessage(string $message, string $datetime): self
    {
        $message = sprintf(self::MESSAGE_TEMPLATE, $datetime, $message);

        return new self($message, EventType::Notify);
    }
}
