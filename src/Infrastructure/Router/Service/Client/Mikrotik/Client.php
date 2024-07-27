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

namespace UnBlockerService\Infrastructure\Router\Service\Client\Mikrotik;

use Illuminate\Support\Arr;
use RouterOS\Exceptions\BadCredentialsException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\ConnectException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Interfaces\QueryInterface;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use UnBlockerService\Domain\Router\Service\Client\Mikrotik\ClientInterface;
use UnBlockerService\Domain\Router\Service\Client\Mikrotik\Exception\ClientException;
use UnBlockerService\Domain\Subnet\Entity\ReadOnlySubnetInterface;

#[Autoconfigure]
class Client implements ClientInterface
{
    private readonly array $config;

    private \RouterOS\Interfaces\ClientInterface $client;

    public function __construct(
        #[Autowire(env: 'MIKROTIK_ADDRESS')]
        string $address,
        #[Autowire(env: 'int:MIKROTIK_PORT')]
        int $port,
        #[Autowire(env: 'MIKROTIK_USER')]
        string $user,
        #[Autowire(env: 'MIKROTIK_PASSWORD')]
        string $password,
        #[Autowire(env: 'bool:MIKROTIK_LEGACY_MODE')]
        bool $isLegacy
    ) {
        $this->config = ['host' => $address, 'port' => $port, 'user' => $user, 'pass' => $password, 'legacy' => $isLegacy];
    }

    public function query(ReadOnlySubnetInterface $subnet, QueryInterface $query): array
    {
        try {
            $response = $this->getClient()->query($query)->read() ?? [];

            if ($message = Arr::get($response, 'after.message')) {
                throw new ClientException($message);
            }

            return $response;
        } catch (\Throwable $e) {
            throw ClientException::fromThrowable($e);
        }
    }

    private function getClient(): \RouterOS\Interfaces\ClientInterface
    {
        try {
            return $this->client ??= new \RouterOS\Client($this->config);
        } catch (BadCredentialsException|ConfigException|ConnectException|QueryException|\RouterOS\Exceptions\ClientException $e) {
            throw ClientException::fromThrowable($e);
        }
    }
}
