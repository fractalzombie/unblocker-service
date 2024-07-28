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

namespace UnBlockerService\Infrastructure\Symfony\Validator\Constraint;

use Symfony\Component\Validator\Constraint;
use UnBlockerService\Infrastructure\Symfony\Validator\Enum\EntityOperation;

#[\Attribute(\Attribute::TARGET_PROPERTY)]
final class Unique extends Constraint
{
    public const string MT_VIOLATION_ERROR = '{{ class }} with {{ property }}: {{ value }} already exists';

    /**
     * @psalm-template TEntity
     *
     * @psalm-param class-string<TEntity> $class
     */
    public function __construct(
        public readonly string $class,
        public readonly string $property,
        public readonly string $idProperty = 'id',
        public readonly ?string $idPath = 'uid',
        public readonly ?EntityOperation $type = EntityOperation::Create,
        mixed $options = null,
        ?array $groups = null,
        mixed $payload = null
    ) {
        if (!\in_array($type, EntityOperation::cases(), true)) {
            $message = \sprintf(
                'Property "%s" in class "%s" has not valid value "%s", allowed "%s"',
                $property,
                self::class,
                $type->value,
                implode(', ', EntityOperation::cases())
            );

            throw new \InvalidArgumentException($message);
        }

        parent::__construct($options, $groups, $payload);
    }

    public function isType(EntityOperation $type): bool
    {
        return $this->type === $type;
    }
}
