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

namespace UnBlockerService\Domain\Subnet\Processor;

use ApiPlatform\Metadata\Operation;
use ApiPlatform\State\ProcessorInterface;
use UnBlockerService\Domain\Subnet\Repository\SubnetRepositoryInterface;
use UnBlockerService\Domain\Subnet\Request\PostSubnetRequest;
use UnBlockerService\Domain\Subnet\Response\PostSubnetResponse;
use UnBlockerService\Infrastructure\Doctrine\Entity\Subnet;

/**
 * @implements ProcessorInterface<PostSubnetRequest, ?PostSubnetResponse>
 */
readonly class PostSubnetProcessor implements ProcessorInterface
{
    public function __construct(
        private SubnetRepositoryInterface $repository,
    ) {}

    public function process(mixed $data, Operation $operation, array $uriVariables = [], array $context = []): ?PostSubnetResponse
    {
        $now = new \DateTimeImmutable();

        $subnet = new Subnet(
            $data->address,
            $data->mask,
            $data->country,
            $now,
            $now,
        );

        $this->repository->persist($subnet);

        return new PostSubnetResponse(
            $subnet->getId(),
            $subnet->getSubnet(),
            $subnet->getMask(),
            $subnet->getCreatedAt(),
            $subnet->getCountry(),
        );
    }
}
