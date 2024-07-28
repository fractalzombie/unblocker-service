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

namespace UnBlockerService\Domain\Common\Service\Manipulator;

interface ClockManipulatorInterface
{
    public function now(): \DateTimeInterface;

    public function nowAsFormatted(?string $format = null): string;

    public function fromFormat(string $datetime, ?string $format = null): \DateTimeInterface;

    public function withTimeZone(\DateTimeZone|string $timezone): self;

    public function sleep(float|int $seconds): void;

    public function defaultTimeZone(bool $asName = false): \DateTimeZone|string;

    public function defaultFormat(): string;
}
