<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Symfony\Validator\Constraints;

use Fp\Collections\ArrayList;
use FRZB\Component\DependencyInjection\Attribute\AsService;
use FRZB\Component\DependencyInjection\Attribute\AsTagged;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;

#[AsService, AsTagged(ConstraintValidatorInterface::class)]
class EnumValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Enum) {
            throw new UnexpectedTypeException($constraint, Enum::class);
        }

        if (!\is_array($constraint->choices) && !$constraint->class) {
            throw new ConstraintDefinitionException('Either "choices" or "class" must be specified on constraint Enum.');
        }

        if (null === $value) {
            return;
        }

        if ($constraint->multiple && !\is_array($value)) {
            throw new UnexpectedValueException($value, 'array');
        }

        match (true) {
            $constraint->multiple => ArrayList::collect($value)
                ->first(static fn (mixed $_value) => !\in_array($_value, $constraint->choices, true))
                ->map(static fn (mixed $_value) => [$_value, $constraint])
                ->tap(fn (array $args) => $this->buildMultipleViolation(...$args)),
            null !== $constraint->min && \count($value) < $constraint->min => $this->buildMinLimitViolation($constraint),
            null !== $constraint->max && \count($value) > $constraint->max => $this->buildMaxLimitViolation($constraint),
            !\in_array($value, $constraint->choices, true) => $this->buildDefaultViolation($value, $constraint),
            default => null,
        };
    }

    private function buildDefaultViolation(mixed $value, Enum $constraint): void
    {
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $this->formatValue($value))
            ->setParameter('{{ choices }}', $this->formatValues($constraint->choices))
            ->setCode(Choice::NO_SUCH_CHOICE_ERROR)
            ->addViolation()
        ;
    }

    private function buildMinLimitViolation(Enum $constraint): void
    {
        $this->context->buildViolation($constraint->minMessage)
            ->setParameter('{{ limit }}', (string) $constraint->min)
            ->setPlural((int) $constraint->min)
            ->setCode(Choice::TOO_FEW_ERROR)
            ->addViolation()
        ;
    }

    private function buildMaxLimitViolation(Enum $constraint): void
    {
        $this->context->buildViolation($constraint->maxMessage)
            ->setParameter('{{ limit }}', (string) $constraint->max)
            ->setPlural((int) $constraint->max)
            ->setCode(Choice::TOO_MANY_ERROR)
            ->addViolation()
        ;
    }

    private function buildMultipleViolation(mixed $value, Enum $constraint): void
    {
        $this->context->buildViolation($constraint->multipleMessage)
            ->setParameter('{{ value }}', $this->formatValue($value))
            ->setParameter('{{ choices }}', $this->formatValues($constraint->choices))
            ->setCode(Choice::NO_SUCH_CHOICE_ERROR)
            ->setInvalidValue($value)
            ->addViolation()
        ;
    }
}
