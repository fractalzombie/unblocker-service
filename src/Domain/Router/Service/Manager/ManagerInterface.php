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

namespace UnBlockerService\Domain\Router\Service\Manager;

use UnBlockerService\Domain\Router\Service\Manager\Exception\ManagerException;
use UnBlockerService\Domain\Router\Service\Manager\Response\AddResponseInterface;
use UnBlockerService\Domain\Router\Service\Manager\Response\GetResponseInterface;
use UnBlockerService\Domain\Subnet\Entity\ReadOnlySubnetInterface;

interface ManagerInterface
{
    /** @throws ManagerException */
    public function getSubnet(ReadOnlySubnetInterface $subnet): GetResponseInterface;

    /** @throws ManagerException */
    public function addSubnet(ReadOnlySubnetInterface $subnet): AddResponseInterface;

    /** @throws ManagerException */
    public function updateSubnet(ReadOnlySubnetInterface $subnet): void;

    /** @throws ManagerException */
    public function removeSubnet(ReadOnlySubnetInterface $subnet): void;

    /** @throws ManagerException */
    public static function getType(): string;
}
