<?php

declare(strict_types=1);

use Psr\EventDispatcher\EventDispatcherInterface;
use UnBlockerService\Domain\Router\Service\Client\Mikrotik\ClientInterface;
use UnBlockerService\Domain\Router\Service\Client\Mikrotik\Exception\ClientException;
use UnBlockerService\Domain\Router\Service\Manager\Exception\ManagerException;
use UnBlockerService\Infrastructure\Router\Service\Manager\Mikrotik\MikrotikManager;
use UnBlockerService\Infrastructure\Router\Service\Manager\Mikrotik\Response\AddResponse;
use UnBlockerService\Infrastructure\Router\Service\Manager\Mikrotik\Response\GetResponse;
use UnBlockerService\Tests\Helper\TestHelper;

function createSuccessClientResponse(string $data): array
{
    return ['after' => ['ret' => $data]];
}

function createErrorClientResponse(string $message): array
{
    return ['after' => ['message' => $message]];
}

test('Test MikrotikManager', function (string $testMethod, ?array $cResponse, ?object $mResponse, bool $isClientThrows): void {
    $routerClient = $this->createMock(ClientInterface::class);
    $eventDispatcher = $this->createMock(EventDispatcherInterface::class);

    $isClientThrows
        ? $routerClient
            ->expects($this->once())
            ->method('query')
            ->willThrowException(new ClientException(TestHelper::MESSAGE))
        : $routerClient
            ->expects($this->once())
            ->method('query')
            ->willReturn($cResponse)
    ;

    $eventDispatcher
        ->expects($this->once())
        ->method('dispatch')
    ;

    if ($isClientThrows) {
        $this->expectException(ManagerException::class);
    }

    $subnetResponse = (new MikrotikManager($routerClient, $eventDispatcher))->{$testMethod}(createSubnet());

    match ($testMethod) {
        'getSubnet' => expect($subnetResponse)->toBeInstanceOf(GetResponse::class)
            ->and($subnetResponse->getAddress())->toBe(TestHelper::SUBNET)
            ->and($subnetResponse->getId())->toBe(TestHelper::ROUTER_ID)
            ->and($subnetResponse->isDynamic())->toBe(false)
            ->and($subnetResponse->getCreatedAt())->toBeInstanceOf(\DateTimeInterface::class),
        'addSubnet' => expect($subnetResponse)->toBeInstanceOf(AddResponse::class)
            ->and($subnetResponse->getId())->toBe(TestHelper::ROUTER_ID),
        default => expect($subnetResponse)->toBeNull(),
    };
})->with([
    [
        'testMethod' => 'getSubnet',
        'clientResponse' => createSuccessClientResponse(TestHelper::getRouterResponse()),
        'mResponse' => GetResponse::fromResponse(createSuccessClientResponse(TestHelper::getRouterResponse())),
        'clientThrows' => false,
    ],
    [
        'testMethod' => 'getSubnet',
        'clientResponse' => createSuccessClientResponse(TestHelper::getRouterResponse()),
        'mResponse' => GetResponse::fromResponse(createSuccessClientResponse(TestHelper::getRouterResponse())),
        'clientThrows' => true,
    ],
    [
        'testMethod' => 'addSubnet',
        'clientResponse' => createSuccessClientResponse(TestHelper::ROUTER_ID),
        'mResponse' => AddResponse::fromResponse(createSuccessClientResponse(TestHelper::ROUTER_ID)),
        'clientThrows' => false,
    ],
    [
        'testMethod' => 'addSubnet',
        'clientResponse' => createSuccessClientResponse(TestHelper::ROUTER_ID),
        'mResponse' => AddResponse::fromResponse(createSuccessClientResponse(TestHelper::ROUTER_ID)),
        'clientThrows' => true,
    ],
    [
        'testMethod' => 'updateSubnet',
        'clientResponse' => [],
        'mResponse' => null,
        'clientThrows' => false,
    ],
    [
        'testMethod' => 'updateSubnet',
        'clientResponse' => [],
        'mResponse' => null,
        'clientThrows' => true,
    ],
    [
        'testMethod' => 'removeSubnet',
        'clientResponse' => [],
        'mResponse' => null,
        'clientThrows' => false,
    ],
    [
        'testMethod' => 'removeSubnet',
        'clientResponse' => [],
        'mResponse' => null,
        'clientThrows' => true,
    ],
]);
