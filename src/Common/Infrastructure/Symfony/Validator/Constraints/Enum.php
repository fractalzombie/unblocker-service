<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Infrastructure\Symfony\Validator\Constraints;

use Fp\Collections\ArrayList;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;

#[\Attribute(\Attribute::TARGET_PROPERTY | \Attribute::TARGET_METHOD | \Attribute::IS_REPEATABLE)]
class Enum extends Constraint
{
    final public const NO_SUCH_CHOICE_ERROR = '8e179f1b-97aa-4560-a02f-2a8b42e49df7';
    final public const TOO_FEW_ERROR = '11edd7eb-5872-4b6e-9f12-89923999fd0e';
    final public const TOO_MANY_ERROR = '9bd98e49-211c-433f-8630-fd1c2d0f08c3';

    private const MESSAGE_TEMPLATE = 'The value you selected is not a valid choice.';
    private const MULTIPLE_MESSAGE_TEMPLATE = 'One or more of the given values is invalid.';
    private const MIN_MESSAGE_TEMPLATE = 'You must select at least {{ limit }} choice.|You must select at least {{ limit }} choices.';
    private const MAX_MESSAGE_TEMPLATE = 'You must select at most {{ limit }} choice.|You must select at most {{ limit }} choices.';

    protected static $errorNames = [
        self::NO_SUCH_CHOICE_ERROR => 'NO_SUCH_CHOICE_ERROR',
        self::TOO_FEW_ERROR => 'TOO_FEW_ERROR',
        self::TOO_MANY_ERROR => 'TOO_MANY_ERROR',
    ];

    public function __construct(
        public ?string $class = null,
        public string|array|null $choices = null,
        public bool $multiple = false,
        public ?int $min = null,
        public ?int $max = null,
        public string $message = self::MESSAGE_TEMPLATE,
        public string $multipleMessage = self::MULTIPLE_MESSAGE_TEMPLATE,
        public string $minMessage = self::MIN_MESSAGE_TEMPLATE,
        public string $maxMessage = self::MAX_MESSAGE_TEMPLATE,
        ?array $groups = null,
        mixed $payload = null,
        array $options = []
    ) {
        match (true) {
            $class && !is_subclass_of($class, \BackedEnum::class) => throw new UnexpectedTypeException($class, \BackedEnum::class),
            is_subclass_of($class, \BackedEnum::class) => $this->choices = ArrayList::collect($class::cases())->map(static fn (\BackedEnum $e) => $e->value)->toArray(),
            array_is_list($choices) => $options = array_merge(ArrayList::collect($choices)->filterOf(\BackedEnum::class)->map(static fn (\BackedEnum $e) => $e->value)->toArray(), $options),
            null !== $choices => $options['value'] = $choices,
            default => null,
        };

        parent::__construct($options, $groups, $payload);
    }

    /** {@inheritdoc} */
    public function getDefaultOption(): ?string
    {
        return 'choices';
    }
}
