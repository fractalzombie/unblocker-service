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

namespace UnBlockerService\Infrastructure\Symfony\EventDispatcher\EventListener;

use Symfony\Component\EventDispatcher\Attribute\AsEventListener;
use Symfony\Component\HttpFoundation\InputBag;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpKernel\KernelEvents;

#[AsEventListener(event: KernelEvents::REQUEST, priority: 10)]
class RequestBuilderEventListener
{
    private const string ROUTE_PARAMS_KEY = '_route_params';

    public function __invoke(RequestEvent $event): void
    {
        //        $request = $event->getRequest();
        //
        //        $payload = [
        //            ...$request->request->all(),
        //            ...$request->query->all(),
        //            ...$request->attributes->get(self::ROUTE_PARAMS_KEY, []),
        //        ];
        //
        //        $request->request = new InputBag($payload);
    }
}
