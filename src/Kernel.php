<?php

declare(strict_types=1);

namespace UnBlockerService;

use Symfony\Bundle\FrameworkBundle\Kernel\MicroKernelTrait;
use Symfony\Component\HttpKernel\Kernel as BaseKernel;

class Kernel extends BaseKernel
{
    use MicroKernelTrait;

    public static function fromContext(array $context): static
    {
        return new self($context['APP_ENV'], (bool) $context['APP_DEBUG']);
    }
}
