<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Service\Downloader\Exception;

use UnBlockerService\Domain\Common\Trait\CreatesFromThrowableTrait;

final class SerializerException extends \LogicException
{
    use CreatesFromThrowableTrait;
}
