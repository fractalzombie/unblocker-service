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

namespace UnBlockerService\Infrastructure\Symfony\Validator\Validator;

use Fp\Collections\ArrayList;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\Constraints\Choice;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Exception\ConstraintDefinitionException;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use Symfony\Component\Validator\Exception\UnexpectedValueException;
use UnBlockerService\Infrastructure\Symfony\Validator\Constraint\Enum;
use UnBlockerService\Infrastructure\Symfony\Validator\Enum\EnumViolationType;
use UnBlockerService\Infrastructure\Symfony\Validator\ValueObject\EnumViolation;

#[Autoconfigure, AutoconfigureTag(ConstraintValidatorInterface::class)]
class EnumValidator extends ConstraintValidator
{
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (null === $value) {
            return;
        }

        if (!$constraint instanceof Enum) {
            throw new UnexpectedTypeException($constraint, Enum::class);
        }

        if (!\is_array($constraint->choices) && !$constraint->class) {
            throw new ConstraintDefinitionException('Either "choices" or "class" must be specified on constraint Enum.');
        }

        if ($constraint->multiple && !\is_array($value)) {
            throw new UnexpectedValueException($value, 'array');
        }

        match ($this->getViolationType($constraint, $value)) {
            EnumViolationType::Multiple => $this->buildMultipleViolation($value, $constraint),
            EnumViolationType::MinLimit => $this->buildLimitViolation($constraint, Choice::TOO_FEW_ERROR, $constraint->min),
            EnumViolationType::MaxLimit => $this->buildLimitViolation($constraint, Choice::TOO_MANY_ERROR, $constraint->max),
            EnumViolationType::InvalidChoices => $this->buildDefaultViolation($value, $constraint),
            EnumViolationType::Ok => null,
        };
    }

    private static function getViolationType(Enum $constraint, array $value): EnumViolationType
    {
        return match (true) {
            $constraint->multiple => EnumViolationType::Multiple,
            null !== $constraint->min && \count($value) < $constraint->min => EnumViolationType::MinLimit,
            null !== $constraint->max && \count($value) > $constraint->max => EnumViolationType::MaxLimit,
            !\in_array($value, $constraint->choices, true) => EnumViolationType::InvalidChoices,
            default => EnumViolationType::Ok,
        };
    }

    private function buildDefaultViolation(mixed $value, Enum $constraint): void
    {
        $this->context->buildViolation($constraint->message)
            ->setParameter('{{ value }}', $this->formatValue($value))
            ->setParameter('{{ choices }}', $this->formatValues($constraint->choices))
            ->setCode(Choice::NO_SUCH_CHOICE_ERROR)
            ->addViolation();
    }

    private function buildLimitViolation(Enum $constraint, string $code, ?int $value): void
    {
        $this->context->buildViolation($constraint->minMessage)
            ->setParameter('{{ limit }}', (string) $value)
            ->setPlural((int) $value)
            ->setCode($code)
            ->addViolation();
    }

    private function buildMultipleViolation(mixed $value, Enum $constraint): void
    {
        ArrayList::collect($value)
            ->first(static fn (mixed $_value) => !\in_array($_value, $constraint->choices, true))
            ->map(static fn (mixed $_value) => new EnumViolation($_value, $constraint))
            ->tap(fn (EnumViolation $violation) => $this->context->buildViolation($violation->constraint->multipleMessage)
                ->setParameter('{{ value }}', $this->formatValue($violation->value))
                ->setParameter('{{ choices }}', $this->formatValues($violation->constraint->choices))
                ->setCode(Choice::NO_SUCH_CHOICE_ERROR)
                ->setInvalidValue($value)
                ->addViolation());
    }
}
