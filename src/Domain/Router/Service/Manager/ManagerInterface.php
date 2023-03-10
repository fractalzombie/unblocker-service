<?php

declare(strict_types=1);

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
