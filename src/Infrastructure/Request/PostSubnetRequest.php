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

namespace UnBlockerService\Infrastructure\Request;

use ApiPlatform\Doctrine\Orm\State\Options;
use ApiPlatform\Metadata as Rest;
use JetBrains\PhpStorm\Immutable;
use Symfony\Component\Validator\Constraints as Assert;
use UnBlockerService\Domain\Subnet\Response\PostSubnetResponse;
use UnBlockerService\Infrastructure\Doctrine\Entity\Subnet;
use UnBlockerService\Infrastructure\Subnet\Processor\SubnetResourceProcessor;

#[Immutable]
#[Rest\ApiResource(
    shortName: 'Subnet',
    operations: [
        new Rest\Post(
            uriTemplate: '/subnets',
            openapiContext: ['tags' => ['Subnets']],
            output: PostSubnetResponse::class,
            processor: SubnetResourceProcessor::class,
        ),
    ],
    class: Subnet::class,
    stateOptions: new Options(Subnet::class),
)]
final class PostSubnetRequest
{
    public function __construct(
        #[Assert\Country]
        public string $country,
        #[Assert\Ip]
        public string $address,
        #[Assert\Type('int')]
        public int $mask,
    ) {}
}
