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
