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

use Fp\Collections\ArrayList;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Enum extends Constraint
{
    final public const string MT_NO_SUCH_CHOICE_ERROR = '8e179f1b-97aa-4560-a02f-2a8b42e49df7';
    final public const string MT_TOO_FEW_ERROR = '11edd7eb-5872-4b6e-9f12-89923999fd0e';
    final public const string MT_TOO_MANY_ERROR = '9bd98e49-211c-433f-8630-fd1c2d0f08c3';

    protected const array ERROR_NAMES = [
        self::MT_NO_SUCH_CHOICE_ERROR => 'NO_SUCH_CHOICE_ERROR',
        self::MT_TOO_FEW_ERROR => 'TOO_FEW_ERROR',
        self::MT_TOO_MANY_ERROR => 'TOO_MANY_ERROR',
    ];

    private const string MT_GENERAL = 'The value you selected is not a valid choice.';
    private const string MT_MULTIPLE = 'One or more of the given values is invalid.';
    private const string MT_MIN = 'You must select at least {{ limit }} choice.|You must select at least {{ limit }} choices.';
    private const string MT_MAX = 'You must select at most {{ limit }} choice.|You must select at most {{ limit }} choices.';

    public function __construct(
        public ?string $class = null,
        public null|array|string $choices = null,
        public bool $multiple = false,
        public ?int $min = null,
        public ?int $max = null,
        public string $message = self::MT_GENERAL,
        public string $multipleMessage = self::MT_MULTIPLE,
        public string $minMessage = self::MT_MIN,
        public string $maxMessage = self::MT_MAX,
        ?array $groups = null,
        mixed $payload = null,
        array $options = []
    ) {
        match (true) {
            $class && !is_subclass_of($class, \BackedEnum::class) => self::whenClassIsNotEnum($this->class),
            is_subclass_of($class, \BackedEnum::class) => $this->choices = self::whenClassIsEnum($this->class),
            array_is_list($choices) => $options = self::whenChoicesIsList($this->choices, $options),
            null !== $choices => $options['value'] = $choices,
            default => null,
        };

        parent::__construct($options, $groups, $payload);
    }

    public function getDefaultOption(): ?string
    {
        return 'choices';
    }

    private static function whenClassIsNotEnum(string $class): never
    {
        throw new UnexpectedTypeException($class, \BackedEnum::class);
    }

    /** @psalm-param class-string<\BackedEnum> $class */
    private static function whenClassIsEnum(string $class): array
    {
        return ArrayList::collect($class::cases())->map(static fn (\BackedEnum $e) => $e->value)->toList();
    }

    private static function whenChoicesIsList(array $choices, array $options): array
    {
        $choiceList = ArrayList::collect($choices)
            ->filter(fn (mixed $v) => is_subclass_of($v, \BackedEnum::class))
            ->map(static fn (\BackedEnum $e) => $e->value)
            ->toList();

        return [...$choiceList, ...$options];
    }
}
