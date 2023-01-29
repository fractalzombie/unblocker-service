<?php

declare(strict_types=1);

namespace UnBlockerService\Infrastructure\Common\Service\Manipulator;

use FRZB\Component\DependencyInjection\Attribute\AsService;
use Symfony\Component\Clock\ClockInterface;
use UnBlockerService\Domain\Common\Service\Manipulator\ClockManipulatorInterface;

#[AsService(arguments: [
    '$defaultFormat' => '%env(resolve:CLOCK_DEFAULT_FORMAT)%',
    '$timezone' => '%env(resolve:CLOCK_DEFAULT_TIMEZONE)%',
])]
final class ClockManipulator implements ClockManipulatorInterface
{
    public function __construct(
        private readonly string $defaultFormat,
        private string $timezone,
        private readonly ClockInterface $clock,
    ) {
    }

    public function now(): \DateTimeInterface
    {
        return $this->clock->now()->setTimezone($this->defaultTimeZone());
    }

    public function nowAsFormatted(?string $format = null): string
    {
        return $this->now()->format($format ?? $this->defaultFormat());
    }

    public function withTimeZone(\DateTimeZone|string $timezone): self
    {
        $this->clock->withTimeZone($timezone);
        $this->timezone = $timezone->getName();

        return $this;
    }

    public function sleep(float|int $seconds): void
    {
        $this->clock->sleep($seconds);
    }

    public function fromFormat(string $datetime, ?string $format = null): \DateTimeInterface
    {
        return \DateTimeImmutable::createFromFormat($format ?? $this->defaultFormat(), $datetime, $this->defaultTimeZone());
    }

    public function defaultTimeZone(bool $asName = false): \DateTimeZone|string
    {
        return $asName ? $this->timezone : new \DateTimeZone($this->timezone);
    }

    public function defaultFormat(): string
    {
        return $this->defaultFormat;
    }
}
