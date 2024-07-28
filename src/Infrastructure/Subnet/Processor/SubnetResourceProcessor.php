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

namespace UnBlockerService\Infrastructure\Subnet\Processor;

use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Operation;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use ApiPlatform\Metadata\Put;
use ApiPlatform\State\ProcessorInterface;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use UnBlockerService\Domain\Common\Helper\UriVariablesHelper;
use UnBlockerService\Domain\Subnet\Entity\SubnetInterface;
use UnBlockerService\Domain\Subnet\Enum\SubnetState;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Infrastructure\Doctrine\Entity\Subnet;
use UnBlockerService\Infrastructure\Subnet\Provider\Exception\SubnetDataProviderException;
use UnBlockerService\Resource\SubnetResource;

/**
 * @template-implements ProcessorInterface<SubnetResource, ?SubnetResource>
 */
#[Autoconfigure]
readonly class SubnetResourceProcessor implements ProcessorInterface
{
    public function __construct(
        private SubnetRepositoryInterface $repository,
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): ?SubnetResource
    {
        $subnet = match ($operation::class) {
            Post::class => $this->postOperation($data),
            Patch::class => $this->patchOperation($data, $uriVariables, $context),
            Put::class => $this->putOperation($data, $uriVariables, $context),
            Delete::class => $this->deleteOperation($data, $uriVariables, $context),
            default => throw SubnetDataProviderException::notSupportedOperation($operation),
        };

        return SubnetResource::fromSubnetEntity($subnet);
    }

    private function postOperation(SubnetResource $resource): SubnetInterface
    {
        $subnet = new Subnet(
            $resource->address,
            $resource->mask,
            $resource->country,
            SubnetState::New,
        );

        $this->repository
            ->persist($subnet)
            ->flush();

        return $subnet;
    }

    private function patchOperation(SubnetResource $data, array $uriVariables, array $context): SubnetInterface
    {
        $id = UriVariablesHelper::getUuid($uriVariables);

        $subnet = $this->repository->getOneById($id);

        $subnet
            ->setCountry($data->country)
            ->setAddress($data->address)
            ->setMask($data->mask)
            ->setState(SubnetState::Updated);

        $this->repository
            ->persist($subnet)
            ->flush();

        return $subnet;
    }

    private function putOperation(SubnetResource $data, array $uriVariables, array $context): SubnetInterface
    {
        $id = UriVariablesHelper::getUuid($uriVariables);

        $subnet = $this->repository->getOneById($id);

        $subnet
            ->setCountry($data->country)
            ->setAddress($data->address)
            ->setMask($data->mask)
            ->setState(SubnetState::Updated);

        $this->repository
            ->persist($subnet)
            ->flush();

        return $subnet;
    }

    private function deleteOperation(SubnetResource $data, array $uriVariables, array $context): SubnetInterface
    {
        $id = UriVariablesHelper::getUuid($uriVariables);

        $subnet = $this->repository->getOneById($id);

        $this->repository
            ->remove($subnet)
            ->flush();

        return $subnet;
    }
}
