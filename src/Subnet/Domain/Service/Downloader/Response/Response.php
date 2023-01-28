<?php

declare(strict_types=1);

namespace UnBlockerService\Subnet\Domain\Service\Downloader\Response;

use UnBlockerService\Subnet\Domain\Service\Downloader\Serializer\ValueObject\Subnet;

final readonly class Response
{
    /** @param Subnet[] $subnetList */
    public function __construct(
        public array $subnetList,
    ) {
    }
}
