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

namespace UnBlockerService\Domain\Router\Service\Manager\Response;

interface GetResponseInterface
{
    public function getId(): string;

    public function getAddress(): string;

    public function getCreatedAt(): \DateTimeImmutable;

    public function isDynamic(): bool;

    public function getGroupName(): string;
}
