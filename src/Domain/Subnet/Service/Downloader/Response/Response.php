<?php

declare(strict_types=1);

namespace UnBlockerService\Domain\Subnet\Service\Downloader\Response;

use UnBlockerService\Domain\Subnet\Service\Downloader\Serializer\ValueObject\Subnet;

final readonly class Response
{
    /** @param Subnet[] $subnetList */
    public function __construct(
        public array $subnetList,
    ) {
    }
}
