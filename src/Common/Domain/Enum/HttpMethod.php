<?php

declare(strict_types=1);

namespace UnBlockerService\Common\Domain\Enum;

enum HttpMethod: string
{
    public const HEAD = 'HEAD';
    public const GET = 'GET';
    public const POST = 'POST';
    public const PUT = 'PUT';
    public const PATCH = 'PATCH';
    public const DELETE = 'DELETE';
    public const PURGE = 'PURGE';
    public const OPTIONS = 'OPTIONS';
    public const TRACE = 'TRACE';
    public const CONNECT = 'CONNECT';

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
}
