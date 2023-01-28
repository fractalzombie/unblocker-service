<?php declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Helper;

use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Common\Infrastructure\Doctrine\Trait\HasPrivateConstructor;
use UnBlockerService\Subnet\Domain\Entity\ReadOnlySubnetInterface;
use UnBlockerService\Subnet\Domain\Message\EventMessage;
use UnBlockerService\Subnet\Domain\Service\Downloader\Serializer\ValueObject\Subnet;

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

    public static function makeSubnetFromEventMessage(EventMessage $message): string
    {
        return self::makeSubnets($message->address, $message->mask);
    }

    public static function getAddressAndMask(string $subnet): array
    {
        [$address, $mask] = SubnetHelper::getAddressAndMask($subnet);

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

        return match(true) {
            $firstAddress === $secondAddress && $firstMask !== $secondMask => false,
            $firstAddress !== $secondAddress && $firstMask === $secondMask => false,
            default => true,
        };
    }
}