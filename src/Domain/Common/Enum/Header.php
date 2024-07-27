<?php

/** @noinspection PhpUnused */

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

use UnBlockerService\Infrastructure\Doctrine\Trait\PrivateConstructorTrait;

/**
 * HTTP Headers based on IANA Message Headers Registry and Wikipedia list.
 *
 * @see https://www.iana.org/assignments/message-headers/message-headers.xml#perm-headers
 * @see https://www.iana.org/assignments/message-headers/message-headers.xml#prov-headers
 * @see https://en.wikipedia.org/wiki/List_of_HTTP_header_fields#Common_non-standard_request_fields
 * @see https://en.wikipedia.org/wiki/List_of_HTTP_header_fields#Common_non-standard_response_fields
 */
abstract class Header
{
    use PrivateConstructorTrait;

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string A_IM = 'A-IM';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.3.2
     */
    final public const string ACCEPT = 'Accept';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string ACCEPT_ADDITIONS = 'Accept-Additions';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.3.3
     */
    final public const string ACCEPT_CHARSET = 'Accept-Charset';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7089
     */
    final public const string ACCEPT_DATETIME = 'Accept-Datetime';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.3.4
     * @see https://tools.ietf.org/html/rfc7694#section-3
     */
    final public const string ACCEPT_ENCODING = 'Accept-Encoding';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string ACCEPT_FEATURES = 'Accept-Features';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.3.5
     */
    final public const string ACCEPT_LANGUAGE = 'Accept-Language';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc5789
     */
    final public const string ACCEPT_PATCH = 'Accept-Patch';

    /**
     * @var string
     *
     * @see https://www.w3.org/TR/ldp/
     */
    final public const string ACCEPT_POST = 'Accept-Post';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7233#section-2.3
     */
    final public const string ACCEPT_RANGES = 'Accept-Ranges';

    /** @var string */
    final public const string APPLICATION = 'app';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7234#section-5.1
     */
    final public const string AGE = 'Age';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-7.4.1
     */
    final public const string ALLOW = 'Allow';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7639#section-2
     */
    final public const string ALPN = 'ALPN';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7838
     */
    final public const string ALT_SVC = 'Alt-Svc';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7838
     */
    final public const string ALT_USED = 'Alt-Used';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string ALTERNATES = 'Alternates';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4437
     */
    final public const string APPLY_TO_REDIRECT_REF = 'Apply-To-Redirect-Ref';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc8053#section-4
     */
    final public const string AUTHENTICATION_CONTROL = 'Authentication-Control';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7615#section-3
     */
    final public const string AUTHENTICATION_INFO = 'Authentication-Info';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7235#section-4.2
     */
    final public const string AUTHORIZATION = 'Authorization';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string C_EXT = 'C-Ext';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string C_MAN = 'C-Man';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string C_OPT = 'C-Opt';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string C_PEP = 'C-PEP';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string C_PEP_INFO = 'C-PEP-Info';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7234#section-5.2
     */
    final public const string CACHE_CONTROL = 'Cache-Control';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7809#section-7.1
     */
    final public const string CALDAV_TIMEZONES = 'CalDAV-Timezones';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-8.1
     */
    final public const string CLOSE = 'Close';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-6.1
     */
    final public const string CONNECTION = 'Connection';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc2068
     * @deprecated
     */
    final public const string CONTENT_BASE = 'Content-Base';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6266
     */
    final public const string CONTENT_DISPOSITION = 'Content-Disposition';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-3.1.2.2
     */
    final public const string CONTENT_ENCODING = 'Content-Encoding';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string CONTENT_ID = 'Content-ID';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-3.1.3.2
     */
    final public const string CONTENT_LANGUAGE = 'Content-Language';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-3.3.2
     */
    final public const string CONTENT_LENGTH = 'Content-Length';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-3.1.4.2
     */
    final public const string CONTENT_LOCATION = 'Content-Location';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string CONTENT_MD5 = 'Content-MD5';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7233#section-4.2
     */
    final public const string CONTENT_RANGE = 'Content-Range';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string CONTENT_SCRIPT_TYPE = 'Content-Script-Type';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string CONTENT_STYLE_TYPE = 'Content-Style-Type';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-3.1.1.5
     */
    final public const string CONTENT_TYPE = 'Content-Type';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string CONTENT_VERSION = 'Content-Version';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6265
     */
    final public const string COOKIE = 'Cookie';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc2965
     * @deprecated
     */
    final public const string COOKIE2 = 'Cookie2';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc5323
     */
    final public const string DASL = 'DASL';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const string DAV = 'DAV';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-7.1.1.2
     */
    final public const string DATE = 'Date';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string DEFAULT_STYLE = 'Default-Style';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string DELTA_BASE = 'Delta-Base';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const string DEPTH = 'Depth';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string DERIVED_FROM = 'Derived-From';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const string DESTINATION = 'Destination';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string DIFFERENTIAL_ID = 'Differential-ID';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string DIGEST = 'Digest';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7232#section-2.3
     */
    final public const string ETAG = 'ETag';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.1.1
     */
    final public const string EXPECT = 'Expect';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7234#section-5.3
     */
    final public const string EXPIRES = 'Expires';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string EXT = 'Ext';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7239
     */
    final public const string FORWARDED = 'Forwarded';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.5.1
     */
    final public const string FROM = 'From';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string GETPROFILE = 'GetProfile';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7486#section-6.1.1
     */
    final public const string HOBAREG = 'Hobareg';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-5.4
     */
    final public const string HOST = 'Host';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7540#section-3.2.1
     */
    final public const string HTTP2_SETTINGS = 'HTTP2-Settings';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string IM = 'IM';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const string IF = 'If';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7232#section-3.1
     */
    final public const string IF_MATCH = 'If-Match';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7232#section-3.3
     */
    final public const string IF_MODIFIED_SINCE = 'If-Modified-Since';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7232#section-3.2
     */
    final public const string IF_NONE_MATCH = 'If-None-Match';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7233#section-3.2
     */
    final public const string IF_RANGE = 'If-Range';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6638
     */
    final public const string IF_SCHEDULE_TAG_MATCH = 'If-Schedule-Tag-Match';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7232#section-3.4
     */
    final public const string IF_UNMODIFIED_SINCE = 'If-Unmodified-Since';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string KEEP_ALIVE = 'Keep-Alive';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string LABEL = 'Label';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7232#section-2.2
     */
    final public const string LAST_MODIFIED = 'Last-Modified';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc5988
     */
    final public const string LINK = 'Link';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-7.1.2
     */
    final public const string LOCATION = 'Location';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const string LOCK_TOKEN = 'Lock-Token';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string MAN = 'Man';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.1.2
     */
    final public const string MAX_FORWARDS = 'Max-Forwards';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7089
     */
    final public const string MEMENTO_DATETIME = 'Memento-Datetime';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string METER = 'Meter';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231
     */
    final public const string MIME_VERSION = 'MIME-Version';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string NEGOTIATE = 'Negotiate';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string OPT = 'Opt';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc8053#section-3
     */
    final public const string OPTIONAL_WWW_AUTHENTICATE = 'Optional-WWW-Authenticate';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string ORDERING_TYPE = 'Ordering-Type';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6454
     */
    final public const string ORIGIN = 'Origin';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const string OVERWRITE = 'Overwrite';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string P3P = 'P3P';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string PEP = 'PEP';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string PICS_LABEL = 'PICS-Label';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string PEP_INFO = 'Pep-Info';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string POSITION = 'Position';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7234#section-5.4
     */
    final public const string PRAGMA = 'Pragma';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7240
     */
    final public const string PREFER = 'Prefer';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7240
     */
    final public const string PREFERENCE_APPLIED = 'Preference-Applied';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string PROFILEOBJECT = 'ProfileObject';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string PROTOCOL = 'Protocol';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string PROTOCOL_INFO = 'Protocol-Info';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string PROTOCOL_QUERY = 'Protocol-Query';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string PROTOCOL_REQUEST = 'Protocol-Request';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7235#section-4.3
     */
    final public const string PROXY_AUTHENTICATE = 'Proxy-Authenticate';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7615#section-4
     */
    final public const string PROXY_AUTHENTICATION_INFO = 'Proxy-Authentication-Info';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7235#section-4.4
     */
    final public const string PROXY_AUTHORIZATION = 'Proxy-Authorization';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string PROXY_FEATURES = 'Proxy-Features';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string PROXY_INSTRUCTION = 'Proxy-Instruction';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string PUBLIC = 'Public';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7469
     */
    final public const string PUBLIC_KEY_PINS = 'Public-Key-Pins';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7469
     */
    final public const string PUBLIC_KEY_PINS_REPORT_ONLY = 'Public-Key-Pins-Report-Only';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7233#section-3.1
     */
    final public const string RANGE = 'Range';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4437
     */
    final public const string REDIRECT_REF = 'Redirect-Ref';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.5.2
     */
    final public const string REFERER = 'Referer';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-7.1.3
     */
    final public const string RETRY_AFTER = 'Retry-After';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string SAFE = 'Safe';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6638
     */
    final public const string SCHEDULE_REPLY = 'Schedule-Reply';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6638
     */
    final public const string SCHEDULE_TAG = 'Schedule-Tag';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6455
     */
    final public const string SEC_WEBSOCKET_ACCEPT = 'Sec-WebSocket-Accept';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6455
     */
    final public const string SEC_WEBSOCKET_EXTENSIONS = 'Sec-WebSocket-Extensions';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6455
     */
    final public const string SEC_WEBSOCKET_KEY = 'Sec-WebSocket-Key';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6455
     */
    final public const string SEC_WEBSOCKET_PROTOCOL = 'Sec-WebSocket-Protocol';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6455
     */
    final public const string SEC_WEBSOCKET_VERSION = 'Sec-WebSocket-Version';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string SECURITY_SCHEME = 'Security-Scheme';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-7.4.2
     */
    final public const string SERVER = 'Server';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6265
     */
    final public const string SET_COOKIE = 'Set-Cookie';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc2965
     * @deprecated
     */
    final public const string SET_COOKIE2 = 'Set-Cookie2';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string SETPROFILE = 'SetProfile';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc5023
     */
    final public const string SLUG = 'SLUG';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string SOAPACTION = 'SoapAction';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string STATUS_URI = 'Status-URI';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6797
     */
    final public const string STRICT_TRANSPORT_SECURITY = 'Strict-Transport-Security';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string SURROGATE_CAPABILITY = 'Surrogate-Capability';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string SURROGATE_CONTROL = 'Surrogate-Control';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string TCN = 'TCN';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-4.3
     */
    final public const string TE = 'TE';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const string TIMEOUT = 'Timeout';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc8030#section-5.4
     */
    final public const string TOPIC = 'Topic';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-4.4
     */
    final public const string TRAILER = 'Trailer';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-3.3.1
     */
    final public const string TRANSFER_ENCODING = 'Transfer-Encoding';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc8030#section-5.2
     */
    final public const string TTL = 'TTL';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc8030#section-5.3
     */
    final public const string URGENCY = 'Urgency';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string URI = 'URI';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-6.7
     */
    final public const string UPGRADE = 'Upgrade';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.5.3
     */
    final public const string USER_AGENT = 'User-Agent';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string VARIANT_VARY = 'Variant-Vary';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-7.1.4
     */
    final public const string VARY = 'Vary';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-5.7.1
     */
    final public const string VIA = 'Via';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7235#section-4.1
     */
    final public const string WWW_AUTHENTICATE = 'WWW-Authenticate';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string WANT_DIGEST = 'Want-Digest';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7234#section-5.5
     */
    final public const string WARNING = 'Warning';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7034
     */
    final public const string X_FRAME_OPTIONS = 'X-Frame-Options';

    // Provisional Message Headers

    /**
     * @var string
     *
     * @deprecated
     */
    final public const string ACCESS_CONTROL = 'Access-Control';

    /**
     * @var string
     *
     * @see https://fetch.spec.whatwg.org/#http-requests
     */
    final public const string ACCESS_CONTROL_ALLOW_CREDENTIALS = 'Access-Control-Allow-Credentials';

    /** @var string */
    final public const string ACCESS_CONTROL_ALLOW_HEADERS = 'Access-Control-Allow-Headers';

    /** @var string */
    final public const string ACCESS_CONTROL_ALLOW_METHODS = 'Access-Control-Allow-Methods';

    /** @var string */
    final public const string ACCESS_CONTROL_ALLOW_ORIGIN = 'Access-Control-Allow-Origin';

    /** @var string */
    final public const string ACCESS_CONTROL_MAX_AGE = 'Access-Control-Max-Age';

    /** @var string */
    final public const string ACCESS_CONTROL_REQUEST_METHOD = 'Access-Control-Request-Method';

    /** @var string */
    final public const string ACCESS_CONTROL_REQUEST_HEADERS = 'Access-Control-Request-Headers';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string COMPLIANCE = 'Compliance';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string CONTENT_TRANSFER_ENCODING = 'Content-Transfer-Encoding';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string COST = 'Cost';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6017
     */
    final public const string EDIINT_FEATURES = 'EDIINT-Features';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string MESSAGE_ID = 'Message-ID';

    /**
     * @var string
     *
     * @deprecated
     */
    final public const string METHOD_CHECK = 'Method-Check';

    /**
     * @var string
     *
     * @deprecated
     */
    final public const string METHOD_CHECK_EXPIRES = 'Method-Check-Expires';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string NON_COMPLIANCE = 'Non-Compliance';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string OPTIONAL = 'Optional';

    /**
     * @var string
     *
     * @deprecated
     */
    final public const string REFERER_ROOT = 'Referer-Root';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string RESOLUTION_HINT = 'Resolution-Hint';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string RESOLVER_LOCATION = 'Resolver-Location';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string SUBOK = 'SubOK';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string SUBST = 'Subst';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string TITLE = 'Title';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string UA_COLOR = 'UA-Color';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string UA_MEDIA = 'UA-Media';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string UA_PIXELS = 'UA-Pixels';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string UA_RESOLUTION = 'UA-Resolution';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string UA_WINDOWPIXELS = 'UA-Windowpixels';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const string VERSION = 'Version';

    /** @var string */
    final public const string X_DEVICE_ACCEPT = 'X-Device-Accept';

    /** @var string */
    final public const string X_DEVICE_ACCEPT_CHARSET = 'X-Device-Accept-Charset';

    /** @var string */
    final public const string X_DEVICE_ACCEPT_ENCODING = 'X-Device-Accept-Encoding';

    /** @var string */
    final public const string X_DEVICE_ACCEPT_LANGUAGE = 'X-Device-Accept-Language';

    /** @var string */
    final public const string X_DEVICE_USER_AGENT = 'X-Device-User-Agent';

    // Non-standard Headers

    /**
     * @var string
     *
     * @see https://www.w3.org/TR/CSP3/#csp-header
     */
    final public const string CONTENT_SECURITY_POLICY = 'Content-Security-Policy';

    /** @var string */
    final public const string DNT = 'DNT';

    /** @var string */
    final public const string PROXY_CONNECTION = 'Proxy-Connection';

    /** @var string */
    final public const string STATUS = 'Status';

    /** @var string */
    final public const string UPGRADE_INSECURE_REQUESTS = 'Upgrade-Insecure-Requests';

    /** @var string */
    final public const string X_CONTENT_DURATION = 'X-Content-Duration';

    /** @var string */
    final public const string X_CONTENT_SECURITY_POLICY = 'X-Content-Security-Policy';

    /** @var string */
    final public const string X_CONTENT_TYPE_OPTIONS = 'X-Content-Type-Options';

    /** @var string */
    final public const string X_CORRELATION_ID = 'X-Correlation-ID';

    /** @var string */
    final public const string X_PLATFORM_AUTH_TOKEN = 'X-Platform-Auth-Token';

    /** @var string */
    final public const string X_CSRF_TOKEN = 'X-Csrf-Token';

    /** @var string */
    final public const string X_FORWARDED_FOR = 'X-Forwarded-For';

    /** @var string */
    final public const string X_FORWARDED_HOST = 'X-Forwarded-Host';

    /** @var string */
    final public const string X_FORWARDED_PROTO = 'X-Forwarded-Proto';

    /** @var string */
    final public const string X_HTTP_METHOD_OVERRIDE = 'X-Http-Method-Override';

    /** @var string */
    final public const string X_POWERED_BY = 'X-Powered-By';

    /** @var string */
    final public const string X_REQUEST_ID = 'X-Request-ID';

    /** @var string */
    final public const string X_PAY_TOKEN = 'X-PAY-TOKEN';

    /** @var string */
    final public const string X_CBH_CORRELATION_ID = 'X-CBH-CORRELATION-ID';

    /** @var string */
    final public const string X_REQUESTED_WITH = 'X-Requested-With';

    /** @var string */
    final public const string X_UA_COMPATIBLE = 'X-UA-Compatible';

    /** @var string */
    final public const string X_UIDH = 'X-UIDH';

    /** @var string */
    final public const string X_WAP_PROFILE = 'X-Wap-Profile';

    /** @var string */
    final public const string X_WEBKIT_CSP = 'X-WebKit-CSP';

    /** @var string */
    final public const string X_XSS_PROTECTION = 'X-XSS-Protection';

    /** @var string */
    final public const string X_HTTP_HAS_ERROR = 'X-Http-Has-Error';
}
