<?php

/** @noinspection PhpUnused */

declare(strict_types=1);

namespace UnBlockerService\Common\Domain\Enum;

/**
 * HTTP Headers based on IANA Message Headers Registry and Wikipedia list.
 *
 * @see https://www.iana.org/assignments/message-headers/message-headers.xml#perm-headers
 * @see https://www.iana.org/assignments/message-headers/message-headers.xml#prov-headers
 * @see https://en.wikipedia.org/wiki/List_of_HTTP_header_fields#Common_non-standard_request_fields
 * @see https://en.wikipedia.org/wiki/List_of_HTTP_header_fields#Common_non-standard_response_fields
 */
interface Header
{
    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const A_IM = 'A-IM';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.3.2
     */
    final public const ACCEPT = 'Accept';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const ACCEPT_ADDITIONS = 'Accept-Additions';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.3.3
     */
    final public const ACCEPT_CHARSET = 'Accept-Charset';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7089
     */
    final public const ACCEPT_DATETIME = 'Accept-Datetime';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.3.4
     * @see https://tools.ietf.org/html/rfc7694#section-3
     */
    final public const ACCEPT_ENCODING = 'Accept-Encoding';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const ACCEPT_FEATURES = 'Accept-Features';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.3.5
     */
    final public const ACCEPT_LANGUAGE = 'Accept-Language';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc5789
     */
    final public const ACCEPT_PATCH = 'Accept-Patch';

    /**
     * @var string
     *
     * @see https://www.w3.org/TR/ldp/
     */
    final public const ACCEPT_POST = 'Accept-Post';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7233#section-2.3
     */
    final public const ACCEPT_RANGES = 'Accept-Ranges';

    /** @var string */
    final public const APPLICATION = 'app';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7234#section-5.1
     */
    final public const AGE = 'Age';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-7.4.1
     */
    final public const ALLOW = 'Allow';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7639#section-2
     */
    final public const ALPN = 'ALPN';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7838
     */
    final public const ALT_SVC = 'Alt-Svc';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7838
     */
    final public const ALT_USED = 'Alt-Used';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const ALTERNATES = 'Alternates';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4437
     */
    final public const APPLY_TO_REDIRECT_REF = 'Apply-To-Redirect-Ref';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc8053#section-4
     */
    final public const AUTHENTICATION_CONTROL = 'Authentication-Control';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7615#section-3
     */
    final public const AUTHENTICATION_INFO = 'Authentication-Info';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7235#section-4.2
     */
    final public const AUTHORIZATION = 'Authorization';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const C_EXT = 'C-Ext';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const C_MAN = 'C-Man';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const C_OPT = 'C-Opt';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const C_PEP = 'C-PEP';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const C_PEP_INFO = 'C-PEP-Info';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7234#section-5.2
     */
    final public const CACHE_CONTROL = 'Cache-Control';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7809#section-7.1
     */
    final public const CALDAV_TIMEZONES = 'CalDAV-Timezones';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-8.1
     */
    final public const CLOSE = 'Close';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-6.1
     */
    final public const CONNECTION = 'Connection';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc2068
     * @deprecated
     */
    final public const CONTENT_BASE = 'Content-Base';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6266
     */
    final public const CONTENT_DISPOSITION = 'Content-Disposition';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-3.1.2.2
     */
    final public const CONTENT_ENCODING = 'Content-Encoding';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const CONTENT_ID = 'Content-ID';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-3.1.3.2
     */
    final public const CONTENT_LANGUAGE = 'Content-Language';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-3.3.2
     */
    final public const CONTENT_LENGTH = 'Content-Length';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-3.1.4.2
     */
    final public const CONTENT_LOCATION = 'Content-Location';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const CONTENT_MD5 = 'Content-MD5';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7233#section-4.2
     */
    final public const CONTENT_RANGE = 'Content-Range';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const CONTENT_SCRIPT_TYPE = 'Content-Script-Type';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const CONTENT_STYLE_TYPE = 'Content-Style-Type';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-3.1.1.5
     */
    final public const CONTENT_TYPE = 'Content-Type';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const CONTENT_VERSION = 'Content-Version';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6265
     */
    final public const COOKIE = 'Cookie';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc2965
     * @deprecated
     */
    final public const COOKIE2 = 'Cookie2';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc5323
     */
    final public const DASL = 'DASL';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const DAV = 'DAV';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-7.1.1.2
     */
    final public const DATE = 'Date';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const DEFAULT_STYLE = 'Default-Style';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const DELTA_BASE = 'Delta-Base';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const DEPTH = 'Depth';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const DERIVED_FROM = 'Derived-From';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const DESTINATION = 'Destination';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const DIFFERENTIAL_ID = 'Differential-ID';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const DIGEST = 'Digest';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7232#section-2.3
     */
    final public const ETAG = 'ETag';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.1.1
     */
    final public const EXPECT = 'Expect';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7234#section-5.3
     */
    final public const EXPIRES = 'Expires';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const EXT = 'Ext';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7239
     */
    final public const FORWARDED = 'Forwarded';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.5.1
     */
    final public const FROM = 'From';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const GETPROFILE = 'GetProfile';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7486#section-6.1.1
     */
    final public const HOBAREG = 'Hobareg';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-5.4
     */
    final public const HOST = 'Host';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7540#section-3.2.1
     */
    final public const HTTP2_SETTINGS = 'HTTP2-Settings';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const IM = 'IM';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const IF = 'If';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7232#section-3.1
     */
    final public const IF_MATCH = 'If-Match';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7232#section-3.3
     */
    final public const IF_MODIFIED_SINCE = 'If-Modified-Since';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7232#section-3.2
     */
    final public const IF_NONE_MATCH = 'If-None-Match';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7233#section-3.2
     */
    final public const IF_RANGE = 'If-Range';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6638
     */
    final public const IF_SCHEDULE_TAG_MATCH = 'If-Schedule-Tag-Match';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7232#section-3.4
     */
    final public const IF_UNMODIFIED_SINCE = 'If-Unmodified-Since';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const KEEP_ALIVE = 'Keep-Alive';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const LABEL = 'Label';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7232#section-2.2
     */
    final public const LAST_MODIFIED = 'Last-Modified';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc5988
     */
    final public const LINK = 'Link';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-7.1.2
     */
    final public const LOCATION = 'Location';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const LOCK_TOKEN = 'Lock-Token';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const MAN = 'Man';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.1.2
     */
    final public const MAX_FORWARDS = 'Max-Forwards';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7089
     */
    final public const MEMENTO_DATETIME = 'Memento-Datetime';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const METER = 'Meter';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231
     */
    final public const MIME_VERSION = 'MIME-Version';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const NEGOTIATE = 'Negotiate';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const OPT = 'Opt';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc8053#section-3
     */
    final public const OPTIONAL_WWW_AUTHENTICATE = 'Optional-WWW-Authenticate';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const ORDERING_TYPE = 'Ordering-Type';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6454
     */
    final public const ORIGIN = 'Origin';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const OVERWRITE = 'Overwrite';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const P3P = 'P3P';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const PEP = 'PEP';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const PICS_LABEL = 'PICS-Label';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const PEP_INFO = 'Pep-Info';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const POSITION = 'Position';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7234#section-5.4
     */
    final public const PRAGMA = 'Pragma';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7240
     */
    final public const PREFER = 'Prefer';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7240
     */
    final public const PREFERENCE_APPLIED = 'Preference-Applied';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const PROFILEOBJECT = 'ProfileObject';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const PROTOCOL = 'Protocol';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const PROTOCOL_INFO = 'Protocol-Info';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const PROTOCOL_QUERY = 'Protocol-Query';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const PROTOCOL_REQUEST = 'Protocol-Request';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7235#section-4.3
     */
    final public const PROXY_AUTHENTICATE = 'Proxy-Authenticate';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7615#section-4
     */
    final public const PROXY_AUTHENTICATION_INFO = 'Proxy-Authentication-Info';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7235#section-4.4
     */
    final public const PROXY_AUTHORIZATION = 'Proxy-Authorization';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const PROXY_FEATURES = 'Proxy-Features';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const PROXY_INSTRUCTION = 'Proxy-Instruction';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const PUBLIC = 'Public';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7469
     */
    final public const PUBLIC_KEY_PINS = 'Public-Key-Pins';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7469
     */
    final public const PUBLIC_KEY_PINS_REPORT_ONLY = 'Public-Key-Pins-Report-Only';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7233#section-3.1
     */
    final public const RANGE = 'Range';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4437
     */
    final public const REDIRECT_REF = 'Redirect-Ref';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.5.2
     */
    final public const REFERER = 'Referer';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-7.1.3
     */
    final public const RETRY_AFTER = 'Retry-After';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const SAFE = 'Safe';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6638
     */
    final public const SCHEDULE_REPLY = 'Schedule-Reply';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6638
     */
    final public const SCHEDULE_TAG = 'Schedule-Tag';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6455
     */
    final public const SEC_WEBSOCKET_ACCEPT = 'Sec-WebSocket-Accept';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6455
     */
    final public const SEC_WEBSOCKET_EXTENSIONS = 'Sec-WebSocket-Extensions';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6455
     */
    final public const SEC_WEBSOCKET_KEY = 'Sec-WebSocket-Key';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6455
     */
    final public const SEC_WEBSOCKET_PROTOCOL = 'Sec-WebSocket-Protocol';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6455
     */
    final public const SEC_WEBSOCKET_VERSION = 'Sec-WebSocket-Version';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const SECURITY_SCHEME = 'Security-Scheme';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-7.4.2
     */
    final public const SERVER = 'Server';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6265
     */
    final public const SET_COOKIE = 'Set-Cookie';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc2965
     * @deprecated
     */
    final public const SET_COOKIE2 = 'Set-Cookie2';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const SETPROFILE = 'SetProfile';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc5023
     */
    final public const SLUG = 'SLUG';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const SOAPACTION = 'SoapAction';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const STATUS_URI = 'Status-URI';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6797
     */
    final public const STRICT_TRANSPORT_SECURITY = 'Strict-Transport-Security';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const SURROGATE_CAPABILITY = 'Surrogate-Capability';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const SURROGATE_CONTROL = 'Surrogate-Control';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const TCN = 'TCN';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-4.3
     */
    final public const TE = 'TE';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4918
     */
    final public const TIMEOUT = 'Timeout';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc8030#section-5.4
     */
    final public const TOPIC = 'Topic';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-4.4
     */
    final public const TRAILER = 'Trailer';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-3.3.1
     */
    final public const TRANSFER_ENCODING = 'Transfer-Encoding';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc8030#section-5.2
     */
    final public const TTL = 'TTL';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc8030#section-5.3
     */
    final public const URGENCY = 'Urgency';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const URI = 'URI';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-6.7
     */
    final public const UPGRADE = 'Upgrade';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-5.5.3
     */
    final public const USER_AGENT = 'User-Agent';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const VARIANT_VARY = 'Variant-Vary';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7231#section-7.1.4
     */
    final public const VARY = 'Vary';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7230#section-5.7.1
     */
    final public const VIA = 'Via';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7235#section-4.1
     */
    final public const WWW_AUTHENTICATE = 'WWW-Authenticate';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const WANT_DIGEST = 'Want-Digest';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7234#section-5.5
     */
    final public const WARNING = 'Warning';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc7034
     */
    final public const X_FRAME_OPTIONS = 'X-Frame-Options';

    // Provisional Message Headers

    /**
     * @var string
     *
     * @deprecated
     */
    final public const ACCESS_CONTROL = 'Access-Control';

    /**
     * @var string
     *
     * @see https://fetch.spec.whatwg.org/#http-requests
     */
    final public const ACCESS_CONTROL_ALLOW_CREDENTIALS = 'Access-Control-Allow-Credentials';

    /** @var string */
    final public const ACCESS_CONTROL_ALLOW_HEADERS = 'Access-Control-Allow-Headers';

    /** @var string */
    final public const ACCESS_CONTROL_ALLOW_METHODS = 'Access-Control-Allow-Methods';

    /** @var string */
    final public const ACCESS_CONTROL_ALLOW_ORIGIN = 'Access-Control-Allow-Origin';

    /** @var string */
    final public const ACCESS_CONTROL_MAX_AGE = 'Access-Control-Max-Age';

    /** @var string */
    final public const ACCESS_CONTROL_REQUEST_METHOD = 'Access-Control-Request-Method';

    /** @var string */
    final public const ACCESS_CONTROL_REQUEST_HEADERS = 'Access-Control-Request-Headers';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const COMPLIANCE = 'Compliance';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const CONTENT_TRANSFER_ENCODING = 'Content-Transfer-Encoding';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const COST = 'Cost';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc6017
     */
    final public const EDIINT_FEATURES = 'EDIINT-Features';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const MESSAGE_ID = 'Message-ID';

    /**
     * @var string
     *
     * @deprecated
     */
    final public const METHOD_CHECK = 'Method-Check';

    /**
     * @var string
     *
     * @deprecated
     */
    final public const METHOD_CHECK_EXPIRES = 'Method-Check-Expires';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const NON_COMPLIANCE = 'Non-Compliance';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const OPTIONAL = 'Optional';

    /**
     * @var string
     *
     * @deprecated
     */
    final public const REFERER_ROOT = 'Referer-Root';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const RESOLUTION_HINT = 'Resolution-Hint';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const RESOLVER_LOCATION = 'Resolver-Location';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const SUBOK = 'SubOK';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const SUBST = 'Subst';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const TITLE = 'Title';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const UA_COLOR = 'UA-Color';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const UA_MEDIA = 'UA-Media';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const UA_PIXELS = 'UA-Pixels';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const UA_RESOLUTION = 'UA-Resolution';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const UA_WINDOWPIXELS = 'UA-Windowpixels';

    /**
     * @var string
     *
     * @see https://tools.ietf.org/html/rfc4229
     */
    final public const VERSION = 'Version';

    /** @var string */
    final public const X_DEVICE_ACCEPT = 'X-Device-Accept';

    /** @var string */
    final public const X_DEVICE_ACCEPT_CHARSET = 'X-Device-Accept-Charset';

    /** @var string */
    final public const X_DEVICE_ACCEPT_ENCODING = 'X-Device-Accept-Encoding';

    /** @var string */
    final public const X_DEVICE_ACCEPT_LANGUAGE = 'X-Device-Accept-Language';

    /** @var string */
    final public const X_DEVICE_USER_AGENT = 'X-Device-User-Agent';

    // Non-standard Headers

    /**
     * @var string
     *
     * @see https://www.w3.org/TR/CSP3/#csp-header
     */
    final public const CONTENT_SECURITY_POLICY = 'Content-Security-Policy';

    /** @var string */
    final public const DNT = 'DNT';

    /** @var string */
    final public const PROXY_CONNECTION = 'Proxy-Connection';

    /** @var string */
    final public const STATUS = 'Status';

    /** @var string */
    final public const UPGRADE_INSECURE_REQUESTS = 'Upgrade-Insecure-Requests';

    /** @var string */
    final public const X_CONTENT_DURATION = 'X-Content-Duration';

    /** @var string */
    final public const X_CONTENT_SECURITY_POLICY = 'X-Content-Security-Policy';

    /** @var string */
    final public const X_CONTENT_TYPE_OPTIONS = 'X-Content-Type-Options';

    /** @var string */
    final public const X_CORRELATION_ID = 'X-Correlation-ID';

    /** @var string */
    final public const X_PLATFORM_AUTH_TOKEN = 'X-Platform-Auth-Token';

    /** @var string */
    final public const X_CSRF_TOKEN = 'X-Csrf-Token';

    /** @var string */
    final public const X_FORWARDED_FOR = 'X-Forwarded-For';

    /** @var string */
    final public const X_FORWARDED_HOST = 'X-Forwarded-Host';

    /** @var string */
    final public const X_FORWARDED_PROTO = 'X-Forwarded-Proto';

    /** @var string */
    final public const X_HTTP_METHOD_OVERRIDE = 'X-Http-Method-Override';

    /** @var string */
    final public const X_POWERED_BY = 'X-Powered-By';

    /** @var string */
    final public const X_REQUEST_ID = 'X-Request-ID';

    /** @var string */
    final public const X_PAY_TOKEN = 'X-PAY-TOKEN';

    /** @var string */
    final public const X_CBH_CORRELATION_ID = 'X-CBH-CORRELATION-ID';

    /** @var string */
    final public const X_REQUESTED_WITH = 'X-Requested-With';

    /** @var string */
    final public const X_UA_COMPATIBLE = 'X-UA-Compatible';

    /** @var string */
    final public const X_UIDH = 'X-UIDH';

    /** @var string */
    final public const X_WAP_PROFILE = 'X-Wap-Profile';

    /** @var string */
    final public const X_WEBKIT_CSP = 'X-WebKit-CSP';

    /** @var string */
    final public const X_XSS_PROTECTION = 'X-XSS-Protection';

    /** @var string */
    final public const X_HTTP_HAS_ERROR = 'X-Http-Has-Error';
}
