<?php

declare(strict_types=1);

/**
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND,
 * EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT.
 *
 * Copyright (c) 2024 Mykhailo Shtanko fractalzombie@gmail.com
 *
 * For the full copyright and license information, please view the LICENSE.MD
 * file that was distributed with this source code.
 */

namespace UnBlockerService\Domain\Common\Enum;

enum ServicePriority: int
{
    case Highest = 2048;
    case High = 256;
    case Normal = 0;
    case Low = -256;
    case Lowest = -2048;
    public const int HIGHEST = 2048;
    public const int HIGH = 256;
    public const int NORMAL = 0;
    public const int LOW = -256;
    public const int LOWEST = -2048;
}
