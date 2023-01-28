<?php

declare(strict_types=1);

namespace UnBlockerService\Router\Domain\Service\Manipulator;

use UnBlockerService\Router\Domain\Service\Manipulator\Exception\ManipulatorException;
use UnBlockerService\Router\Domain\Service\Manipulator\Response\AddResponseInterface;
use UnBlockerService\Router\Domain\Service\Manipulator\Response\GetResponseInterface;
use UnBlockerService\Subnet\Domain\Entity\ReadOnlySubnetInterface;

interface ManagerInterface
{
    /** @throws ManipulatorException */
    public function getSubnet(ReadOnlySubnetInterface $subnet): GetResponseInterface;

    /** @throws ManipulatorException */
    public function addSubnet(ReadOnlySubnetInterface $subnet): AddResponseInterface;

    /** @throws ManipulatorException */
    public function updateSubnet(ReadOnlySubnetInterface $subnet): void;

    /** @throws ManipulatorException */
    public function removeSubnet(ReadOnlySubnetInterface $subnet): void;

    /** @throws ManipulatorException */
    public static function getType(): string;
}
