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

enum HttpMethod: string
{
    case Head = self::HEAD;
    case Get = self::GET;
    case Post = self::POST;
    case Put = self::PUT;
    case Patch = self::PATCH;
    case Delete = self::DELETE;
    case Purge = self::PURGE;
    case Options = self::OPTIONS;
    case Trace = self::TRACE;
    case Connect = self::CONNECT;

    public const string HEAD = 'HEAD';
    public const string GET = 'GET';
    public const string POST = 'POST';
    public const string PUT = 'PUT';
    public const string PATCH = 'PATCH';
    public const string DELETE = 'DELETE';
    public const string PURGE = 'PURGE';
    public const string OPTIONS = 'OPTIONS';
    public const string TRACE = 'TRACE';
    public const string CONNECT = 'CONNECT';
}
