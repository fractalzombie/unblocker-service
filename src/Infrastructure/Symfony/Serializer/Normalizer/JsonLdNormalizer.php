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

namespace UnBlockerService\Infrastructure\Symfony\Serializer\Normalizer;

use ApiPlatform\Exception\InvalidUriVariableException;
use ApiPlatform\Metadata\UriVariableTransformerInterface;
use Symfony\Component\DependencyInjection\Attribute\AutoconfigureTag;
use Symfony\Component\Uid\Uuid;

#[AutoconfigureTag(UriVariableTransformerInterface::class)]
class JsonLdNormalizer implements UriVariableTransformerInterface
{
    public function transform(mixed $value, array $types, array $context = []): Uuid
    {
        try {
            return Uuid::fromString($value);
        } catch (\InvalidArgumentException $e) {
            throw new InvalidUriVariableException($e->getMessage(), $e->getCode(), $e);
        }
    }

    public function supportsTransformation(mixed $value, array $types, array $context = []): bool
    {
        return \is_string($value) && Uuid::isValid($value);
    }
}
