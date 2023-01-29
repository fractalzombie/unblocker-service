<?php

declare(strict_types=1);

namespace UnBlockerService\Tests\Helper;

use Fp\Collections\ArrayList;
use Symfony\Component\Uid\Uuid;
use UnBlockerService\Domain\Subnet\Entity\SubnetInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Service\Downloader\Serializer\ValueObject\Subnet as SubnetValueObject;
use UnBlockerService\Infrastructure\Doctrine\Entity\Subnet;
use UnBlockerService\Infrastructure\Doctrine\Trait\HasPrivateConstructor;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\AddEventMessage;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\CreateEventMessage;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\NotifyEventMessage;
use UnBlockerService\Infrastructure\Symfony\Messenger\Message\UpdateEventMessage;

/** @internal */
final readonly class TestHelper
{
    use HasPrivateConstructor;

    public const SUBNETS = [
        self::COUNTRY_USA => [
            '85.92.0.0/19',
            '85.92.108.0/22',
            '85.92.116.0/23',
            '85.92.118.0/24',
            '85.93.32.0/19',
            '85.93.128.0/19',
            '81.177.140.32/32',
            '85.94.0.0/19',
            '85.94.32.0/19',
            '85.95.128.0/19',
            '85.95.160.0/19',
        ],
        self::COUNTRY_UA => [
            '85.112.32.0/19',
            '85.112.96.0/19',
            '85.113.32.0/19',
            '85.113.128.0/19',
            '85.113.192.0/19',
            '85.114.0.0/19',
            '85.114.64.0/19',
            '85.114.160.0/19',
            '85.115.160.0/19',
            '81.177.143.251/32',
            '85.115.200.0/22',
        ],
    ];

    public const UUID = 'c3098ca4-f73d-4983-b345-0c1f541f0fb5';
    public const MESSAGE = 'Something goes wrong';
    public const NOTIFY_MESSAGE = 'Notify message';
    public const NOTIFY_MESSAGE_TEMPLATE = 'Executed at %s: %s';
    public const ADDRESS = '192.168.88.0';
    public const MASK = 24;
    public const SUBNET = self::ADDRESS.'/'.self::MASK;
    public const ROUTER_ID = '*5ABLS';
    public const COUNTRY_USA = 'USA';
    public const COUNTRY_UA = 'UA';
    public const GROUP_NAME = 'BLACKLIST_'.self::COUNTRY_USA;
    public const ATTRIBUTE_PROPERTY_VALUE = 'attribute-test-value';
    public const CLASS_PROPERTY_VALUE = 'property-test-value';

    public const PROVIDER_USA = ['url' => 'https://example.com/path/to/subnet-list.txt', 'country' => self::COUNTRY_USA];
    public const PROVIDER_UA = ['url' => 'https://example.ua/path/to/subnet-list.txt', 'country' => self::COUNTRY_UA];

    public static function getRouterResponse(): string
    {
        $response = '.id=%s;address=%s;creation-time=%s;dynamic=%s;list=%s';
        $attributes = [self::ROUTER_ID, self::SUBNET, (new \DateTimeImmutable())->format('M/d/Y H:i:s'), false, self::GROUP_NAME];

        return sprintf($response, ...$attributes);
    }

    /** @return string[] */
    public static function getTestSubnetsAsArray(string $provider): array
    {
        return self::SUBNETS[$provider] ?? [];
    }

    public static function getTestSubnetsAsString(string $provider): string
    {
        return implode(\PHP_EOL, self::getTestSubnetsAsArray($provider));
    }

    /** @return SubnetInterface[] */
    public static function getDatabaseSubnetsAsArray(string $provider): array
    {
        return ArrayList::collect(self::getTestSubnetsAsArray($provider))
            ->map(static fn (string $subnet) => SubnetValueObject::fromSubnet($subnet, $provider))
            ->map(static fn (SubnetValueObject $subnet) => (new Subnet(
                $subnet->address,
                $subnet->mask,
                $subnet->country,
                new \DateTimeImmutable(),
                new \DateTimeImmutable(),
                SubnetState::Created,
            ))->setId(Uuid::v4()))
            ->toArray()
        ;
    }

    /**
     * @template T
     *
     * @param class-string<T> $className
     *
     * @return T
     */
    public static function makeObject(string $className, string $factoryMethod = '__construct', array|object $args = []): object
    {
        return match ($factoryMethod) {
            '__construct' => new $className(...$args),
            default => \is_array($args)
                ? $className::$factoryMethod(...$args)
                : $className::$factoryMethod($args),
        };
    }

    public static function makeSubnetEntity(?Uuid $id = null, ?SubnetState $state = null): Subnet
    {
        $states = SubnetState::cases();

        $subnet = self::makeObject(Subnet::class, args: [
            'address' => self::ADDRESS,
            'mask' => self::MASK,
            'country' => self::COUNTRY_UA,
            'createdAt' => new \DateTimeImmutable(),
            'updatedAt' => new \DateTimeImmutable(),
            'state' => $state ?? $states[array_rand($states)],
        ]);

        $subnet->setExternalId($id ?? (string) Uuid::v4());

        try {
            (new \ReflectionClass($subnet))
                ->getProperty('id')
                ->setValue($subnet, $id ?? Uuid::v4())
            ;
        } catch (\ReflectionException) {
        }

        return $subnet;
    }

    public static function makeSubnetValueObject(?Uuid $id = null, ?SubnetState $state = null): SubnetValueObject
    {
        return self::makeObject(SubnetValueObject::class, 'fromSubnet', [
            'subnet' => self::SUBNET,
            'country' => self::COUNTRY_UA,
        ]);
    }

    public static function makeAddEventMessage(?Uuid $id = null, ?SubnetState $state = null): AddEventMessage
    {
        return self::makeObject(AddEventMessage::class, 'fromSubnet', self::makeSubnetEntity($id, $state));
    }

    public static function makeCreateEventMessage(?Uuid $id = null): CreateEventMessage
    {
        return self::makeObject(CreateEventMessage::class, 'fromSubnet', [
            'subnet' => self::makeSubnetValueObject($id),
            'createdAt' => new \DateTimeImmutable(),
        ]);
    }

    public static function makeUpdateEventMessage(?Uuid $id = null): UpdateEventMessage
    {
        return self::makeObject(UpdateEventMessage::class, 'fromSubnet', self::makeSubnetEntity($id));
    }

    public static function makeNotifyEventMessage(): NotifyEventMessage
    {
        return self::makeObject(NotifyEventMessage::class, 'fromMessage', [
            'message' => self::NOTIFY_MESSAGE,
            'datetime' => (new \DateTimeImmutable())->format(\DateTimeInterface::RFC3339),
        ]);
    }
}
