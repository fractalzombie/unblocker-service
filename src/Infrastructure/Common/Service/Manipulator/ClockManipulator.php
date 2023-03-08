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

    public function defaultTimeZone(): \DateTimeZone
    {
        return new \DateTimeZone($this->timezone);
    }

    public function defaultFormat(): string
    {
        return $this->defaultFormat;
    }
}
