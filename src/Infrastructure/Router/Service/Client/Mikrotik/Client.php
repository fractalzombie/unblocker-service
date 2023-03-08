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

namespace UnBlockerService\Infrastructure\Router\Service\Client\Mikrotik;

use FRZB\Component\DependencyInjection\Attribute\AsService;
use Illuminate\Support\Arr;
use RouterOS\Exceptions\BadCredentialsException;
use RouterOS\Exceptions\ConfigException;
use RouterOS\Exceptions\ConnectException;
use RouterOS\Exceptions\QueryException;
use RouterOS\Interfaces\QueryInterface;
use UnBlockerService\Domain\Router\Service\Client\Mikrotik\ClientInterface;
use UnBlockerService\Domain\Router\Service\Client\Mikrotik\Exception\ClientException;
use UnBlockerService\Domain\Subnet\Entity\ReadOnlySubnetInterface;

#[AsService(arguments: [
    '$address' => '%env(string:MIKROTIK_ADDRESS)%',
    '$user' => '%env(string:MIKROTIK_USER)%',
    '$password' => '%env(string:MIKROTIK_PASSWORD)%',
    '$port' => '%env(int:MIKROTIK_PORT)%',
    '$isLegacy' => '%env(bool:MIKROTIK_LEGACY_MODE)%',
])]
class Client implements ClientInterface
{
    private readonly array $config;

    private \RouterOS\Interfaces\ClientInterface $client;

    public function __construct(string $address, int $port, string $user, string $password, bool $isLegacy)
    {
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
        } catch (BadCredentialsException|ConnectException|\RouterOS\Exceptions\ClientException|ConfigException|QueryException $e) {
            throw ClientException::fromThrowable($e);
        }
    }
}
