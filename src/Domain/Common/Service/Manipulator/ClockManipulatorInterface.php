<?php

declare(strict_types=1);

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

    public function defaultTimeZone(bool $asName = false): \DateTimeZone|string;

    public function defaultFormat(): string;
}
