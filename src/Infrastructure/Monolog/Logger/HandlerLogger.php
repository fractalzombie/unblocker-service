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

namespace UnBlockerService\Infrastructure\Monolog\Logger;

use FRZB\Component\DependencyInjection\Attribute\AsService;
use Psr\Log\LoggerInterface;
use Symfony\Component\Messenger\Event\WorkerMessageFailedEvent;
use Symfony\Component\Messenger\Event\WorkerMessageHandledEvent;
use UnBlockerService\Domain\Common\Logger\ContextExtractor\ContextExtractorLocatorInterface;
use UnBlockerService\Domain\Common\Logger\HandlerLoggerInterface;

#[AsService]
class HandlerLogger implements HandlerLoggerInterface
{
    private const MT_INFO = '[HANDLER] [INFO] [MESSAGE: {message_class}] [ID: {id}] [EXTERNAL_ID: {external_id}] [STATE: {state}] [SUBNET: {subnet}] [GROUP_NAME: {group_name}]';
    private const MT_ERROR = '[HANDLER] [ERROR] [EXCEPTION_CLASS: {exception_class}] [EXCEPTION_MESSAGE: {exception_message}] [ID: {id}] [EXTERNAL_ID: {external_id}] [STATE: {state}] [SUBNET: {subnet}] [GROUP_NAME: {group_name}]';
    private const MT_DATE_TIME_FORMAT = \DateTimeInterface::RFC3339_EXTENDED;

    public function __construct(
        private readonly LoggerInterface $handlerLogger,
        private readonly ContextExtractorLocatorInterface $contextExtractorLocator,
    ) {}

    public function info(WorkerMessageHandledEvent $event): void
    {
        $message = $event->getEnvelope()->getMessage();
        $context = $this->contextExtractorLocator->get($message)->extract($message);

        $this->handlerLogger->info($context->getMessage(), $context->getContext());
    }

    public function error(WorkerMessageFailedEvent $event): void
    {
        $message = $event->getEnvelope()->getMessage();
        $context = $this->contextExtractorLocator->get($message)->extract($message, $event->getThrowable());

        $this->handlerLogger->info($context->getMessage(), $context->getContext());
    }
}
