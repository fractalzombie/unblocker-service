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

namespace UnBlockerService\Infrastructure\Subnet\Provider;

use ApiPlatform\Doctrine\Orm\State\CollectionProvider;
use ApiPlatform\Metadata\GetCollection;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProviderInterface;
use Fp\Collections\ArrayList;
use Symfony\Component\DependencyInjection\Attribute\Autowire;
use UnBlockerService\Domain\Common\Helper\UriVariablesHelper;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Resource\SubnetResource;

/**
 * @template-implements ProviderInterface<SubnetResource>
 */
readonly class SubnetResourceProvider implements ProviderInterface
{
    public function __construct(
        private SubnetRepositoryInterface $subnetRepository,
        #[Autowire(service: CollectionProvider::class)]
        private ProviderInterface $collectionProvider,
    ) {}

    public function provide(Operation $operation, array $uriVariables = [], array $context = []): null|array|object
    {
        return match ($operation::class) {
            GetCollection::class => $this->retrieveCollection($operation, $uriVariables, $context),
            default => $this->retrieveOne($uriVariables),
        };
    }

    private function retrieveCollection(GetCollection $operation, array $uriVariables = [], array $context = []): array
    {
        return ArrayList::collect($this->collectionProvider->provide($operation, $uriVariables, $context))
            ->map(SubnetResource::fromSubnetEntity(...))
            ->toList();
    }

    private function retrieveOne(array $uriVariables = []): ?SubnetResource
    {
        $id = UriVariablesHelper::getUuid($uriVariables);

        if ($subnet = $this->subnetRepository->getOneById($id)) {
            return SubnetResource::fromSubnetEntity($subnet);
        }

        return null;
    }
}
