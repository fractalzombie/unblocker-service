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
