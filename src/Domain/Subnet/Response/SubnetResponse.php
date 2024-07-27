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

namespace UnBlockerService\Domain\Subnet\Response;

use Symfony\Component\Uid\Uuid;
use UnBlockerService\Domain\Subnet\Entity\SubnetInterface;

readonly class SubnetResponse
{
    public function __construct(
        public Uuid $id,
        public string $address,
        public int $mask,
        public \DateTimeInterface $createdAt,
        public string $country
    ) {}

    public static function fromSubnetEntity(SubnetInterface $subnet): static
    {
        return new static(
            $subnet->getId(),
            $subnet->getAddress(),
            $subnet->getMask(),
            $subnet->getCreatedAt(),
            $subnet->getCountry(),
        );
    }
}
