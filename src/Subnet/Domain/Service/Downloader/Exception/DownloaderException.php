<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Service\Downloader\Exception;

use UnBlockerService\Common\Domain\Traits\CreatesFromThrowableTrait;

final class DownloaderException extends \LogicException
{
    use CreatesFromThrowableTrait;
}
