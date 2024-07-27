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

namespace UnBlockerService\Tests\Unit\Router\Infrastructure\Router\Service\Manager\Mikrotik\Response;

use UnBlockerService\Infrastructure\Router\Service\Manager\Mikrotik\Response\AddResponse;
use UnBlockerService\Tests\Helper\TestHelper;

test('test AddResponse', function (array $response): void {
    expect(AddResponse::fromResponse($response)->getId())->toBe(TestHelper::ROUTER_ID);
})->with([
    [['after' => ['ret' => TestHelper::ROUTER_ID]]],
]);
