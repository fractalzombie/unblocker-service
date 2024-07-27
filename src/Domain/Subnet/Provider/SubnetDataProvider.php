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

namespace UnBlockerService\Domain\Subnet\Provider;

use ApiPlatform\Doctrine\Orm\Extension\PaginationExtension;
use ApiPlatform\Doctrine\Orm\Util\QueryNameGenerator;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Fp\Collections\ArrayList;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Domain\Subnet\Response\GetSubnetResponse;

/**
 * @implements ProviderInterface<GetSubnetResponse>
 */
readonly class SubnetDataProvider implements ProviderInterface
{
    public function __construct(
        private SubnetRepositoryInterface $subnetRepository,
        private PaginationExtension $paginationExtension,
    ) {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): null|array|object
    {
        return match ($operation::class) {
            GetCollection::class => $this->provideForCollection($operation, $uriVariables, $context),
            Get::class => $this->provideForOne($operation, $uriVariables, $context),
            default => new \OutOfBoundsException(),
        };
    }

    private function provideForCollection(GetCollection $operation, array $uriVariables = [], array $context = []): array
    {
        $queryBuilder = $this->subnetRepository->createQueryBuilder('s');
        $queryNameGenerator = new QueryNameGenerator();

        $this->paginationExtension->applyToCollection(
            $queryBuilder, $queryNameGenerator, $operation->getClass(), $operation, $context
        );

        return ArrayList::collect($queryBuilder->getQuery()->getResult())
            ->map(GetSubnetResponse::fromSubnetEntity(...))
            ->toList();
    }

    private function provideForOne(Get $operation, array $uriVariables = [], array $context = []): ?GetSubnetResponse
    {
        $id = $uriVariables['id'];

        if ($subnet = $this->subnetRepository->getOneById($id)) {
            return GetSubnetResponse::fromSubnetEntity($subnet);
        }

        return null;
    }
}
