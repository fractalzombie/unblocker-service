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

use Doctrine\ORM\Mapping\Entity;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use UnBlockerService\Domain\Common\Helper\AttributeHelper;
use UnBlockerService\Domain\Common\Helper\ClassHelper;
use UnBlockerService\Infrastructure\Symfony\Validator\Constraint\Exist;
use UnBlockerService\Infrastructure\Symfony\Validator\Exception\EntityValidatorException;
use UnBlockerService\Infrastructure\Symfony\Validator\Repository\CountRepositoryInterface;

#[Autoconfigure, AutoconfigureTag(ConstraintValidatorInterface::class)]
class ExistValidator extends ConstraintValidator
{
    public function __construct(
        private readonly CountRepositoryInterface $countRepository,
    ) {}

    /**
     * @throws EntityValidatorException
     * @throws \InvalidArgumentException
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Exist) {
            throw new UnexpectedTypeException($constraint, Exist::class);
        }

        if (!$value) {
            return;
        }

        if (!\is_string($value) && !\is_float($value) && !\is_int($value) && !\is_array($value)) {
            throw new \InvalidArgumentException('Value must be string, int, float, double or array');
        }

        $entityClass = $constraint->class;
        $entityClassShortName = ClassHelper::getShortName($entityClass);
        $entityProperty = $constraint->property;
        $entityPropertyValue = $value;
        $entityIdProperty = $constraint->idProperty;
        $entityAnnotation = AttributeHelper::getAttribute($entityClass, Entity::class);
        $constraintValue = \is_array($entityPropertyValue)
            ? implode(',', $entityPropertyValue)
            : (string) $entityPropertyValue;

        if (!$entityAnnotation instanceof Entity) {
            throw EntityValidatorException::notEntityClass($entityClass);
        }

        $count = $this->countRepository
            ->getCountOf($entityClass, $entityProperty, $entityPropertyValue, $entityIdProperty);

        if (\count(\is_array($entityPropertyValue) ? $entityPropertyValue : [$entityPropertyValue]) !== $count) {
            $this->context->buildViolation($constraint::MT_VIOLATION_ERROR)
                ->setParameter('{{ class }}', $entityClassShortName)
                ->setParameter('{{ property }}', $constraint->property)
                ->setParameter('{{ value }}', $constraintValue)
                ->addViolation();
        }
    }
}
