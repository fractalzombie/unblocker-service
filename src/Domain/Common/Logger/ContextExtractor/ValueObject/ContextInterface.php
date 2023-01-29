<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Common\Logger\ContextExtractor\ValueObject;

interface ContextInterface
{
    public function getMessage(): string;

    public function getContext(): array;
}
