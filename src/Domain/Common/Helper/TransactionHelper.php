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

namespace UnBlockerService\Domain\Common\Helper;

use Fp\Collections\ArrayList;
use FRZB\Component\TransactionalMessenger\Attribute\Transactional;
use FRZB\Component\TransactionalMessenger\Enum\CommitType;
use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Infrastructure\Doctrine\Trait\PrivateConstructorTrait;

#[Immutable]
final readonly class TransactionHelper
{
    use PrivateConstructorTrait;

    public static function isTransactional(object|string $target): bool
    {
        return AttributeHelper::hasAttribute($target, Transactional::class);
    }

    public static function getTransactional(object|string $target): array
    {
        return AttributeHelper::getAttributes($target, Transactional::class);
    }

    public static function isDispatchable(object|string $target, CommitType ...$commitTypes): bool
    {
        return ArrayList::collect(self::getTransactional($target))
            ->map(static fn (Transactional $t) => $t->commitTypes)
            ->flatten()
            ->toArrayList()
            ->every(static fn (CommitType $ct) => \in_array($ct, $commitTypes, true));
    }
}
