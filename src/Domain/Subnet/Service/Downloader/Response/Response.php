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
