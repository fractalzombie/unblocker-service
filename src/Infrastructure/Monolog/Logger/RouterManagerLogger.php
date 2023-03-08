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

namespace UnBlockerService\Infrastructure\Monolog\Logger;

use FRZB\Component\DependencyInjection\Attribute\AsService;
use Psr\Log\LoggerInterface;
use UnBlockerService\Domain\Common\Service\Manipulator\ClassManipulatorInterface;
use UnBlockerService\Domain\Router\Logger\RouterManagerLoggerInterface;
use UnBlockerService\Domain\Subnet\Entity\ReadOnlySubnetInterface;

#[AsService]
class RouterManagerLogger implements RouterManagerLoggerInterface
{
    private const MT_INFO = '[ROUTER_MANAGER] [INFO] [ID: {id}] [EXTERNAL_ID: {external_id}] [STATE: {state}] [SUBNET: {subnet}] [GROUP_NAME: {group_name}]';
    private const MT_ERROR = '[ROUTER_MANAGER] [ERROR] [EXCEPTION_CLASS: {exception_class}] [EXCEPTION_MESSAGE: {exception_message}] [ID: {id}] [EXTERNAL_ID: {external_id}] [STATE: {state}] [SUBNET: {subnet}] [GROUP_NAME: {group_name}]';
    private const MT_DATE_TIME_FORMAT = \DateTimeInterface::RFC3339_EXTENDED;

    public function __construct(
        private readonly LoggerInterface $subnetManipulatorLogger,
        private readonly ClassManipulatorInterface $classManipulator,
    ) {
    }

    public function info(ReadOnlySubnetInterface $subnet): void
    {
        $context = [
            'id' => (string) $subnet->getId(),
            'external_id' => (string) $subnet->getExternalId() ?? 'EMPTY',
            'state' => $subnet->getState()->value,
            'subnet' => $subnet->getSubnet(),
            'group_name' => $subnet->getGroupName(),
            'created_at' => $subnet->getCreatedAt()->format(self::MT_DATE_TIME_FORMAT),
            'updated_at' => $subnet->getUpdatedAt()->format(self::MT_DATE_TIME_FORMAT),
        ];

        $this->subnetManipulatorLogger->info(self::MT_INFO, $context);
    }

    public function error(ReadOnlySubnetInterface $subnet, \Throwable $exception): void
    {
        $context = [
            'exception_class' => $this->classManipulator->getShortName($exception),
            'exception_message' => $exception->getMessage(),
            'id' => (string) $subnet->getId(),
            'external_id' => (string) $subnet->getExternalId() ?? 'EMPTY',
            'state' => $subnet->getState()->value,
            'subnet' => $subnet->getSubnet(),
            'group_name' => $subnet->getGroupName(),
            'created_at' => $subnet->getCreatedAt()->format(self::MT_DATE_TIME_FORMAT),
            'updated_at' => $subnet->getUpdatedAt()->format(self::MT_DATE_TIME_FORMAT),
        ];

        $this->subnetManipulatorLogger->error(self::MT_ERROR, $context);
    }
}
