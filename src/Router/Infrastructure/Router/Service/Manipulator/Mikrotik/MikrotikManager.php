<?php

declare(strict_types=1);

namespace UnBlockerService\Router\Infrastructure\Router\Service\Manipulator\Mikrotik;

use FRZB\Component\DependencyInjection\Attribute\AsService;
use FRZB\Component\DependencyInjection\Attribute\AsTagged;
use Illuminate\Support\Arr;
use RouterOS\Client;
use RouterOS\Exceptions\BadCredentialsException;
use RouterOS\Exceptions\ClientException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\ConnectException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Query;
use UnBlockerService\Router\Domain\Enum\RouterType;
use UnBlockerService\Router\Domain\Service\Manipulator\Exception\ManipulatorException;
use UnBlockerService\Router\Domain\Service\Manipulator\ManagerInterface;
use UnBlockerService\Router\Domain\Service\Manipulator\Response\AddResponseInterface;
use UnBlockerService\Router\Domain\Service\Manipulator\Response\GetResponseInterface;
use UnBlockerService\Router\Infrastructure\Router\Service\Manipulator\Mikrotik\Response\AddResponse;
use UnBlockerService\Router\Infrastructure\Router\Service\Manipulator\Mikrotik\Response\GetResponse;
use UnBlockerService\Subnet\Domain\Entity\ReadOnlySubnetInterface;

#[AsService(arguments: [
    '$address' => '%env(string:MIKROTIK_ADDRESS)%',
    '$user' => '%env(string:MIKROTIK_USER)%',
    '$password' => '%env(string:MIKROTIK_PASSWORD)%',
    '$port' => '%env(int:MIKROTIK_PORT)%',
    '$isLegacy' => '%env(bool:MIKROTIK_LEGACY_MODE)%',
])]
#[AsTagged(ManagerInterface::class)]
final class MikrotikManager implements ManagerInterface
{
    private const API_URL_ADDRESS_LIST = '/ip/firewall/address-list';

    private const API_URL_ADDRESS_LIST_ADD = self::API_URL_ADDRESS_LIST.'/add';

    private const API_URL_ADDRESS_LIST_GET = self::API_URL_ADDRESS_LIST.'/get';

    private const API_URL_ADDRESS_LIST_UPDATE = self::API_URL_ADDRESS_LIST.'/set';

    private const API_URL_ADDRESS_LIST_REMOVE = self::API_URL_ADDRESS_LIST.'/remove';

    private array $config;

    private Client $client;

    public function __construct(string $address, int $port, string $user, string $password, bool $isLegacy)
    {
        $this->config = ['host' => $address, 'port' => $port, 'user' => $user, 'pass' => $password, 'legacy' => $isLegacy];
    }

    public function getSubnet(ReadOnlySubnetInterface $subnet): GetResponseInterface
    {
        try {
            $query = (new Query(self::API_URL_ADDRESS_LIST_GET))
                ->setAttributes(["=number={$subnet->getExternalId()}"])
            ;
            $response = $this->getClient()->query($query)->read();

            if ($message = Arr::get($response, 'after.message')) {
                throw ManipulatorException::whenAdd($message, $subnet->getSubnet());
            }

            return GetResponse::fromResponse(Arr::get($response, 'after.ret'));
        } catch (\Throwable $e) {
            throw ManipulatorException::fromAddressAndThrowable($subnet->getSubnet(), $e);
        }
    }

    public function addSubnet(ReadOnlySubnetInterface $subnet): AddResponseInterface
    {
        try {
            $query = (new Query(self::API_URL_ADDRESS_LIST_ADD))
                ->setAttributes(["=list={$subnet->getGroupName()}", "=address={$subnet->getSubnet()}"])
            ;

            $response = $this->getClient()->query($query)->read();

            if ($message = Arr::get($response, 'after.message')) {
                throw ManipulatorException::whenAdd($message, $subnet->getSubnet());
            }

            return AddResponse::fromResponse(Arr::get($response, 'after.ret'));
        } catch (\Throwable $e) {
            throw ManipulatorException::fromAddressAndThrowable($subnet->getSubnet(), $e);
        }
    }

    public function updateSubnet(ReadOnlySubnetInterface $subnet): void
    {
        try {
            $query = (new Query(self::API_URL_ADDRESS_LIST_UPDATE))
                ->setAttributes(["=list={$subnet->getGroupName()}", "=address={$subnet->getSubnet()}"])
                ->equal('.id', $subnet->getExternalId())
            ;

            if ($message = Arr::get($this->getClient()->query($query)->read(), 'after.message')) {
                throw ManipulatorException::whenUpdate($message, $subnet->getSubnet());
            }
        } catch (\Throwable $e) {
            throw ManipulatorException::fromAddressAndThrowable($subnet->getSubnet(), $e);
        }
    }

    public function removeSubnet(ReadOnlySubnetInterface $subnet): void
    {
        try {
            $query = (new Query(self::API_URL_ADDRESS_LIST_REMOVE))
                ->equal('.id', $subnet->getExternalId())
            ;

            if ($message = Arr::get($this->getClient()->query($query)->read(), 'after.message')) {
                throw ManipulatorException::whenRemove($message, $subnet->getSubnet());
            }
        } catch (\Throwable $e) {
            throw ManipulatorException::fromAddressAndThrowable($subnet->getSubnet(), $e);
        }
    }

    public static function getType(): string
    {
        return RouterType::MIKROTIK;
    }

    private function getClient(): Client
    {
        try {
            return $this->client ??= new Client($this->config);
        } catch (BadCredentialsException|ConnectException|ClientException|ConfigException|QueryException $e) {
            throw ManipulatorException::fromThrowable($e);
        }
    }
}
