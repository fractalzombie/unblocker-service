<?php

declare(strict_types=1);

namespace UnBlockerService\Tests\Unit\Router\Infrastructure\Router\Service\Manager\Mikrotik\Response;

use UnBlockerService\Infrastructure\Router\Service\Manager\Mikrotik\Response\AddResponse;
use UnBlockerService\Tests\Helper\TestHelper;

test('test AddResponse', function (array $response): void {
    expect(AddResponse::fromResponse($response)->getId())->toBe(TestHelper::ROUTER_ID);
})->with([
    [['after' => ['ret' => TestHelper::ROUTER_ID]]],
]);
