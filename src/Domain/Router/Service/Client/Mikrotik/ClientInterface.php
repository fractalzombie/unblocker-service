<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Router\Service\Client\Mikrotik;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use RouterOS\Interfaces\QueryInterface;
use UnBlockerService\Domain\Router\Service\Client\Mikrotik\Exception\ClientException;
use UnBlockerService\Domain\Subnet\Entity\ReadOnlySubnetInterface;
use UnBlockerService\Infrastructure\Router\Service\Client\Mikrotik\Client;

#[AsAlias(Client::class)]
interface ClientInterface
{
    public const API_URL_ADDRESS_LIST = '/ip/firewall/address-list';

    public const API_URL_ADDRESS_LIST_ADD = self::API_URL_ADDRESS_LIST.'/add';

    public const API_URL_ADDRESS_LIST_GET = self::API_URL_ADDRESS_LIST.'/get';

    public const API_URL_ADDRESS_LIST_UPDATE = self::API_URL_ADDRESS_LIST.'/set';

    public const API_URL_ADDRESS_LIST_REMOVE = self::API_URL_ADDRESS_LIST.'/remove';

    /** @throws ClientException */
    public function query(ReadOnlySubnetInterface $subnet, QueryInterface $query): array;
}
