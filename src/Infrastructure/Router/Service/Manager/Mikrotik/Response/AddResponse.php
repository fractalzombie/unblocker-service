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

namespace UnBlockerService\Infrastructure\Router\Service\Manager\Mikrotik\Response;

use Illuminate\Support\Arr;
use JetBrains\PhpStorm\Immutable;
use UnBlockerService\Domain\Router\Service\Manager\Response\AddResponseInterface;

#[Immutable]
final readonly class AddResponse implements AddResponseInterface
{
    public function __construct(
        private string $id,
    ) {
    }

    public function getId(): string
    {
        return $this->id;
    }

    public static function fromResponse(array $response): self
    {
        return new self(Arr::get($response, 'after.ret'));
    }
}
