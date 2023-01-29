<?php

declare(strict_types=1);

namespace UnBlockerService\Tests\Unit\Router\Domain\Exception;

use UnBlockerService\Domain\Router\Service\Manager\Exception\ManagerException;
use UnBlockerService\Tests\Helper\TestHelper;

test('test ManagerExceptionTest', function (string $message, ManagerException $exception): void {
    expect($exception->getMessage())->toBe('Exception for address 192.168.88.0/24: Something goes wrong');
})->with([
    [
        'Exception for address 192.168.88.0/24: Something goes wrong',
        ManagerException::fromAddressAndThrowable(TestHelper::SUBNET, new \LogicException(TestHelper::MESSAGE)),
    ],
    [
        'Failure to add 192.168.88.0/24 address: Something goes wrong',
        ManagerException::fromAddressAndThrowable(TestHelper::SUBNET, new \LogicException(TestHelper::MESSAGE)),
    ],
    [
        'Failure to update 192.168.88.0/24 address: Something goes wrong',
        ManagerException::fromAddressAndThrowable(TestHelper::SUBNET, new \LogicException(TestHelper::MESSAGE)),
    ],
    [
        'Failure to delete 192.168.88.0/24 address: Something goes wrong',
        ManagerException::fromAddressAndThrowable(TestHelper::SUBNET, new \LogicException(TestHelper::MESSAGE)),
    ],
]);
