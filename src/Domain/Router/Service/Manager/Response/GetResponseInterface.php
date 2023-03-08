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

namespace UnBlockerService\Domain\Router\Service\Manager\Response;

interface GetResponseInterface
{
    public function getId(): string;

    public function getAddress(): string;

    public function getCreatedAt(): \DateTimeImmutable;

    public function isDynamic(): bool;

    public function getGroupName(): string;
}
