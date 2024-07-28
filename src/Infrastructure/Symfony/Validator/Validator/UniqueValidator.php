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

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Entity;
use Doctrine\Persistence\ObjectRepository;
use Symfony\Component\DependencyInjection\Attribute\Autoconfigure;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;
use Symfony\Component\Validator\ConstraintValidatorInterface;
use Symfony\Component\Validator\Exception\UnexpectedTypeException;
use UnBlockerService\Domain\Common\Helper\AttributeHelper;
use UnBlockerService\Domain\Common\Helper\ClassHelper;
use UnBlockerService\Infrastructure\Symfony\Validator\Constraint\Unique;
use UnBlockerService\Infrastructure\Symfony\Validator\Enum\EntityOperation;
use UnBlockerService\Infrastructure\Symfony\Validator\Exception\EntityValidatorException;
use UnBlockerService\Infrastructure\Symfony\Validator\Repository\CountRepositoryInterface;
use UnBlockerService\Infrastructure\Symfony\Validator\Repository\HasCountRepositoryInterface;

#[Autoconfigure, AutoconfigureTag(ConstraintValidatorInterface::class)]
class UniqueValidator extends ConstraintValidator
{
    public const int ALLOWED_COUNT_WHEN_CREATE = 0;
    public const int ALLOWED_COUNT_WHEN_UPDATE = 1;

    public function __construct(
        private readonly EntityManagerInterface $entityManager,
        private readonly CountRepositoryInterface $countRepository,
        private readonly RequestStack $requestStack,
    ) {}

    /**
     * @throws EntityValidatorException
     * @throws \InvalidArgumentException
     */
    public function validate(mixed $value, Constraint $constraint): void
    {
        if (!$constraint instanceof Unique) {
            throw new UnexpectedTypeException($constraint, Unique::class);
        }

        if (!$value) {
            return;
        }

        if (!\is_string($value) && !\is_float($value) && !\is_int($value)) {
            throw new \InvalidArgumentException('Value must be string, int, float, double');
        }

        $entityClass = $constraint->class;
        $entityClassShortName = ClassHelper::getShortName($entityClass);
        $entityProperty = $constraint->property;
        $entityPropertyValue = $value;
        $entityIdProperty = $constraint->idProperty;
        $entityAnnotation = AttributeHelper::getAttribute($entityClass, Entity::class);
        $entityId = $this->requestStack->getCurrentRequest()?->attributes->get($constraint->idPath ?? '');

        if (!$entityAnnotation instanceof Entity) {
            throw EntityValidatorException::notEntityClass($entityClass);
        }

        $repository = $this->entityManager->getRepository($entityClass);

        $count = $repository instanceof HasCountRepositoryInterface
            ? $repository->getCountOf($entityProperty, $entityPropertyValue, $entityIdProperty, $entityId)
            : $this->countRepository->getCountOf($entityClass, $entityProperty, $entityPropertyValue, $entityIdProperty, $entityId);

        $allowedCountWhenUpdate = null !== $entityId ? self::ALLOWED_COUNT_WHEN_CREATE : self::ALLOWED_COUNT_WHEN_UPDATE;
        $isNotUniqueWhenCreate = $count > self::ALLOWED_COUNT_WHEN_CREATE && $constraint->isType(EntityOperation::Create);
        $isNotUniqueWhenUpdate = $count > $allowedCountWhenUpdate && $constraint->isType(EntityOperation::Update);

        if ($isNotUniqueWhenCreate || $isNotUniqueWhenUpdate) {
            $this->context->buildViolation($constraint::MT_VIOLATION_ERROR)
                ->setParameter('{{ class }}', $entityClassShortName)
                ->setParameter('{{ property }}', $constraint->property)
                ->setParameter('{{ value }}', (string) $value)
                ->addViolation();
        }
    }
}
