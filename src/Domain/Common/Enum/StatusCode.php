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

enum StatusCode: int
{
    case Continue = 100;
    case SwitchingProtocols = 101;
    case Processing = 102;
    case EarlyHints = 103;
    case Ok = 200;
    case Created = 201;
    case Accepted = 202;
    case NonAuthoritativeInformation = 203;
    case NoContent = 204;
    case ResetContent = 205;
    case PartialContent = 206;
    case MultiStatus = 207;
    case AlreadyReported = 208;
    case ImUsed = 226;
    case MultipleChoices = 300;
    case MovedPermanently = 301;
    case Found = 302;
    case SeeOther = 303;
    case NotModified = 304;
    case UseProxy = 305;
    case Reserved = 306;
    case TemporaryRedirect = 307;
    case PermanentlyRedirect = 308;
    case BadRequest = 400;
    case Unauthorized = 401;
    case PaymentRequired = 402;
    case Forbidden = 403;
    case NotFound = 404;
    case MethodNotAllowed = 405;
    case NotAcceptable = 406;
    case ProxyAuthenticationRequired = 407;
    case RequestTimeout = 408;
    case Conflict = 409;
    case Gone = 410;
    case LengthRequired = 411;
    case PreconditionFailed = 412;
    case RequestEntityTooLarge = 413;
    case RequestUriTooLong = 414;
    case UnsupportedMediaType = 415;
    case RequestedRangeNotSatisfiable = 416;
    case ExpectationFailed = 417;
    case IAmATeapot = 418;
    case MisdirectedRequest = 421;
    case UnprocessableEntity = 422;
    case Locked = 423;
    case FailedDependency = 424;
    case TooEarly = 425;
    case UpgradeRequired = 426;
    case PreconditionRequired = 428;
    case TooManyRequests = 429;
    case RequestHeaderFieldsTooLarge = 431;
    case UnavailableForLegalReasons = 451;
    case InternalServerError = 500;
    case NotImplemented = 501;
    case BadGateway = 502;
    case ServiceUnavailable = 503;
    case GatewayTimeout = 504;
    case VersionNotSupported = 505;
    case VariantAlsoNegotiatesExperimental = 506;
    case InsufficientStorage = 507;
    case LoopDetected = 508;
    case NotExtended = 510;
    case NetworkAuthenticationRequired = 511;

    final public const int CONTINUE = 100;
    final public const int SWITCHING_PROTOCOLS = 101;
    final public const int PROCESSING = 102;
    final public const int EARLY_HINTS = 103;
    final public const int OK = 200;
    final public const int CREATED = 201;
    final public const int ACCEPTED = 202;
    final public const int NON_AUTHORITATIVE_INFORMATION = 203;
    final public const int NO_CONTENT = 204;
    final public const int RESET_CONTENT = 205;
    final public const int PARTIAL_CONTENT = 206;
    final public const int MULTI_STATUS = 207;
    final public const int ALREADY_REPORTED = 208;
    final public const int IM_USED = 226;
    final public const int MULTIPLE_CHOICES = 300;
    final public const int MOVED_PERMANENTLY = 301;
    final public const int FOUND = 302;
    final public const int SEE_OTHER = 303;
    final public const int NOT_MODIFIED = 304;
    final public const int USE_PROXY = 305;
    final public const int RESERVED = 306;
    final public const int TEMPORARY_REDIRECT = 307;
    final public const int PERMANENTLY_REDIRECT = 308;
    final public const int BAD_REQUEST = 400;
    final public const int UNAUTHORIZED = 401;
    final public const int PAYMENT_REQUIRED = 402;
    final public const int FORBIDDEN = 403;
    final public const int NOT_FOUND = 404;
    final public const int METHOD_NOT_ALLOWED = 405;
    final public const int NOT_ACCEPTABLE = 406;
    final public const int PROXY_AUTHENTICATION_REQUIRED = 407;
    final public const int REQUEST_TIMEOUT = 408;
    final public const int CONFLICT = 409;
    final public const int GONE = 410;
    final public const int LENGTH_REQUIRED = 411;
    final public const int PRECONDITION_FAILED = 412;
    final public const int REQUEST_ENTITY_TOO_LARGE = 413;
    final public const int REQUEST_URI_TOO_LONG = 414;
    final public const int UNSUPPORTED_MEDIA_TYPE = 415;
    final public const int REQUESTED_RANGE_NOT_SATISFIABLE = 416;
    final public const int EXPECTATION_FAILED = 417;
    final public const int I_AM_A_TEAPOT = 418;
    final public const int MISDIRECTED_REQUEST = 421;
    final public const int UNPROCESSABLE_ENTITY = 422;
    final public const int LOCKED = 423;
    final public const int FAILED_DEPENDENCY = 424;
    final public const int TOO_EARLY = 425;
    final public const int UPGRADE_REQUIRED = 426;
    final public const int PRECONDITION_REQUIRED = 428;
    final public const int TOO_MANY_REQUESTS = 429;
    final public const int REQUEST_HEADER_FIELDS_TOO_LARGE = 431;
    final public const int UNAVAILABLE_FOR_LEGAL_REASONS = 451;
    final public const int INTERNAL_SERVER_ERROR = 500;
    final public const int NOT_IMPLEMENTED = 501;
    final public const int BAD_GATEWAY = 502;
    final public const int SERVICE_UNAVAILABLE = 503;
    final public const int GATEWAY_TIMEOUT = 504;
    final public const int VERSION_NOT_SUPPORTED = 505;
    final public const int VARIANT_ALSO_NEGOTIATES_EXPERIMENTAL = 506;
    final public const int INSUFFICIENT_STORAGE = 507;
    final public const int LOOP_DETECTED = 508;
    final public const int NOT_EXTENDED = 510;
    final public const int NETWORK_AUTHENTICATION_REQUIRED = 511;
}
