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

namespace UnBlockerService\Domain\Subnet\Helper;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Infrastructure\Doctrine\Trait\HasPrivateConstructor;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\UpdateEventMessage;

#[Immutable]
final class SubnetHelper
{
    use HasPrivateConstructor;

    public const SEPARATOR = '/';
    private const MASK_MAX_NUMBER = 32;
    private const MASK_MIN_NUMBER = 0;

    public static function makeSubnets(string $address, int $mask): string
    {
        $separator = self::SEPARATOR;

        return "{$address}{$separator}{$mask}";
    }

    public static function makeSubnetFromEventMessage(UpdateEventMessage $message): string
    {
        return self::makeSubnets($message->address, $message->mask);
    }

    public static function getAddressAndMask(string $subnet): array
    {
        [$address, $mask] = explode(self::SEPARATOR, $subnet);

        $mask = match (true) {
            (int) $mask < self::MASK_MIN_NUMBER => self::MASK_MIN_NUMBER,
            (int) $mask > self::MASK_MAX_NUMBER => self::MASK_MAX_NUMBER,
            default => (int) $mask,
        };

        return [$address, $mask];
    }

    public static function equals(string $firstSubnet, string $secondSubnet): bool
    {
        [$firstAddress, $firstMask] = self::getAddressAndMask($firstSubnet);
        [$secondAddress, $secondMask] = self::getAddressAndMask($secondSubnet);

        return match (true) {
            $firstAddress === $secondAddress || $firstMask !== $secondMask => false,
            default => true,
        };
    }
}
