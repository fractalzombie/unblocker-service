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

use UnBlockerService\Infrastructure\Router\Service\Manager\Mikrotik\Response\GetResponse;
use UnBlockerService\Tests\Helper\TestHelper;

test('test GetResponse', function (array $response): void {
    $getResponse = GetResponse::fromResponse($response);

    expect($getResponse->getId())->toBe(TestHelper::ROUTER_ID)
        ->and($getResponse->getAddress())->toBe(TestHelper::SUBNET)
        ->and($getResponse->getCreatedAt())->toBeInstanceOf(\DateTimeInterface::class)
        ->and($getResponse->isDynamic())->toBeBool()
        ->and($getResponse->getGroupName())->toBe(TestHelper::GROUP_NAME)
    ;
})->with([[['after' => ['ret' => TestHelper::getRouterResponse()]]]]);
