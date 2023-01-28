<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Infrastructure\Doctrine\Repository;

use Doctrine\ORM\EntityManagerInterface;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use Happyr\DoctrineSpecification\Repository\EntitySpecificationRepository;
use Happyr\DoctrineSpecification\Result\Cache;
use Happyr\DoctrineSpecification\Result\ResultModifierCollection;
use Symfony\Component\Uid\Uuid;
use UnBlockerService\Subnet\Domain\Entity\SubnetInterface;
use UnBlockerService\Subnet\Domain\Enum\SubnetState;
use UnBlockerService\Subnet\Domain\Repository\SubnetRepositoryInterface;
use UnBlockerService\Subnet\Infrastructure\Doctrine\Entity\Subnet;
use UnBlockerService\Subnet\Infrastructure\Doctrine\Specification\GetByAddressAndMaskSpecification;
use UnBlockerService\Subnet\Infrastructure\Doctrine\Specification\GetByAddressSpecification;
use UnBlockerService\Subnet\Infrastructure\Doctrine\Specification\GetByCountrySpecification;
use UnBlockerService\Subnet\Infrastructure\Doctrine\Specification\GetByIdSpecification;
use UnBlockerService\Subnet\Infrastructure\Doctrine\Specification\GetByStateSpecification;

#[AsService(arguments: ['$cacheSeconds' => '%env(int:DATABASE_SUBNET_CACHE_SECONDS)%'])]
final class SubnetRepository extends EntitySpecificationRepository implements SubnetRepositoryInterface
{
    public function __construct(
        private readonly int $cacheSeconds,
        EntityManagerInterface $em,
    ) {
        parent::__construct($em, $em->getClassMetadata(Subnet::class));
    }

    public function getOneById(Uuid $id): ?SubnetInterface
    {
        return $this->matchOneOrNullResult(
            new GetByIdSpecification($id),
            new Cache($this->cacheSeconds),
        );
    }

    public function getOneByCountry(string $country): ?SubnetInterface
    {
        return $this->matchOneOrNullResult(
            new GetByCountrySpecification($country),
            new Cache($this->cacheSeconds),
        );
    }

    /** @return SubnetInterface[] */
    public function getListByCountry(string $country): array
    {
        return $this->match(
            new GetByCountrySpecification($country),
            new ResultModifierCollection(new Cache($this->cacheSeconds)),
        );
    }

    public function getOneByAddress(string $address): ?SubnetInterface
    {
        return $this->matchOneOrNullResult(
            new GetByAddressSpecification($address),
            new Cache($this->cacheSeconds),
        );
    }

    public function getListByAddress(string $address): array
    {
        return $this->match(
            new GetByAddressSpecification($address),
            new ResultModifierCollection(new Cache($this->cacheSeconds)),
        );
    }

    public function getOneByAddressAndMask(string $address, int $mask): ?SubnetInterface
    {
        return $this->matchOneOrNullResult(
            new GetByAddressAndMaskSpecification($address, $mask),
            new Cache($this->cacheSeconds),
        );
    }

    public function isExistByAddressAndMask(string $address, int $mask): bool
    {
        return (bool) $this->count(['address' => $address, 'mask' => $mask]);
    }

    public function getByStates(SubnetState ...$states): array
    {
        return $this->match(
            new GetByStateSpecification(...$states),
            new Cache($this->cacheSeconds),
        );
    }
}
