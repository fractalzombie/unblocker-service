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

namespace UnBlockerService\Infrastructure\Router\Service\Manager\Mikrotik;

use FRZB\Component\DependencyInjection\Attribute\AsService;
use FRZB\Component\DependencyInjection\Attribute\AsTagged;
use Psr\EventDispatcher\EventDispatcherInterface;
use RouterOS\Interfaces\QueryInterface;
use RouterOS\Query;
use UnBlockerService\Domain\Common\Enum\ProcessState;
use UnBlockerService\Domain\Router\Enum\RouterType;
use UnBlockerService\Domain\Router\Service\Client\Mikrotik\ClientInterface;
use UnBlockerService\Domain\Router\Service\Manager\Exception\ManagerException;
use UnBlockerService\Domain\Router\Service\Manager\ManagerInterface;
use UnBlockerService\Domain\Router\Service\Manager\Response\AddResponseInterface;
use UnBlockerService\Domain\Router\Service\Manager\Response\GetResponseInterface;
use UnBlockerService\Domain\Subnet\Entity\ReadOnlySubnetInterface;
use UnBlockerService\Infrastructure\Router\Service\Manager\Mikrotik\Response\AddResponse;
use UnBlockerService\Infrastructure\Router\Service\Manager\Mikrotik\Response\GetResponse;
use UnBlockerService\Infrastructure\Symfony\EventDispatcher\Event\RouterManagerEvent;

#[AsService, AsTagged(ManagerInterface::class)]
class MikrotikManager implements ManagerInterface
{
    public function __construct(
        private readonly ClientInterface $client,
        private readonly EventDispatcherInterface $eventDispatcher,
    ) {
    }

    public function getSubnet(ReadOnlySubnetInterface $subnet): GetResponseInterface
    {
        try {
            $query = (new Query(ClientInterface::API_URL_ADDRESS_LIST_GET))
                ->setAttributes(["=number={$subnet->getExternalId()}"])
            ;

            return GetResponse::fromResponse($this->query($subnet, $query));
        } catch (\Throwable $e) {
            throw ManagerException::fromAddressAndThrowable($subnet->getSubnet(), $e);
        }
    }

    public function addSubnet(ReadOnlySubnetInterface $subnet): AddResponseInterface
    {
        try {
            $query = (new Query(ClientInterface::API_URL_ADDRESS_LIST_ADD))
                ->setAttributes(["=list={$subnet->getGroupName()}", "=address={$subnet->getSubnet()}"])
            ;

            return AddResponse::fromResponse($this->query($subnet, $query));
        } catch (\Throwable $e) {
            throw ManagerException::fromAddressAndThrowable($subnet->getSubnet(), $e);
        }
    }

    public function updateSubnet(ReadOnlySubnetInterface $subnet): void
    {
        try {
            $query = (new Query(ClientInterface::API_URL_ADDRESS_LIST_UPDATE))
                ->setAttributes(["=list={$subnet->getGroupName()}", "=address={$subnet->getSubnet()}"])
                ->equal('.id', $subnet->getExternalId())
            ;

            $this->query($subnet, $query);
        } catch (\Throwable $e) {
            throw ManagerException::fromAddressAndThrowable($subnet->getSubnet(), $e);
        }
    }

    public function removeSubnet(ReadOnlySubnetInterface $subnet): void
    {
        try {
            $query = (new Query(ClientInterface::API_URL_ADDRESS_LIST_REMOVE))
                ->equal('.id', $subnet->getExternalId())
            ;

            $this->query($subnet, $query);
        } catch (\Throwable $e) {
            throw ManagerException::fromAddressAndThrowable($subnet->getSubnet(), $e);
        }
    }

    public static function getType(): string
    {
        return RouterType::MIKROTIK;
    }

    private function query(ReadOnlySubnetInterface $subnet, QueryInterface $query): array
    {
        try {
            $processState = ProcessState::Success;

            return $this->client->query($subnet, $query);
        } catch (\Throwable $exception) {
            $processState = ProcessState::Failure;

            throw ManagerException::fromAddressAndThrowable($subnet->getSubnet(), $exception);
        } finally {
            $exception ??= null;

            $this->eventDispatcher->dispatch(new RouterManagerEvent($processState, $subnet, $exception));
        }
    }
}
