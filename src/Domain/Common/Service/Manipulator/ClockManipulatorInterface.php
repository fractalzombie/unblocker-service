<?php

declare(strict_types=1);

/*
 * UnBlocker service for routers.
 *
 * (c) Mykhailo Shtanko <fractalzombie@gmail.com>
 *
 * For the full copyright and license information, please view the LICENSE
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Domain\Common\Service\Manipulator;

use FRZB\Component\DependencyInjection\Attribute\AsAlias;
use UnBlockerService\Infrastructure\Common\Service\Manipulator\ClockManipulator;

#[AsAlias(ClockManipulator::class)]
interface ClockManipulatorInterface
{
    public function now(): \DateTimeInterface;

    public function nowAsFormatted(?string $format = null): string;

    public function fromFormat(string $datetime, ?string $format = null): \DateTimeInterface;

    public function withTimeZone(\DateTimeZone|string $timezone): self;

    public function sleep(float|int $seconds): void;

    public function defaultTimeZone(): \DateTimeZone;

    public function defaultFormat(): string;
}
