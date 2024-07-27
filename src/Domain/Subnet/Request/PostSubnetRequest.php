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

namespace UnBlockerService\Domain\Subnet\Request;

use JetBrains\PhpStorm\Immutable;
use Symfony\Component\Validator\Constraints as Assert;

#[Immutable]
final readonly class PostSubnetRequest
{
    public function __construct(
        #[Assert\Country]
        public string $country,
        #[Assert\Ip]
        public string $address,
        #[Assert\Type('int')]
        public int $mask,
        #[Assert\Type(\DateTimeInterface::class)]
        public \DateTimeInterface $fromDateTime,
        #[Assert\Type(\DateTimeInterface::class)]
        public \DateTimeInterface $toDateTime,
    ) {}
}
