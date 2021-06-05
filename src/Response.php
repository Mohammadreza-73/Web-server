<?php

namespace WebServer;

class Response
{
    private int $status;
    private string $body = '';
    private array $headers = [];

    public static $statusMsg = [
        100 => 'Continue',
        101 => 'Switching Protocols',
        102 => 'Processing',            // RFC2518
        103 => 'Early Hints',
        200 => 'OK',
        201 => 'Created',
        202 => 'Accepted',
        203 => 'Non-Authoritative Information',
        204 => 'No Content',
        205 => 'Reset Content',
        206 => 'Partial Content',
        207 => 'Multi-Status',          // RFC4918
        208 => 'Already Reported',      // RFC5842
        226 => 'IM Used',               // RFC3229
        300 => 'Multiple Choices',
        301 => 'Moved Permanently',
        302 => 'Found',
        303 => 'See Other',
        304 => 'Not Modified',
        305 => 'Use Proxy',
        307 => 'Temporary Redirect',
        308 => 'Permanent Redirect',    // RFC7238
        400 => 'Bad Request',
        401 => 'Unauthorized',
        402 => 'Payment Required',
        403 => 'Forbidden',
        404 => 'Not Found',
        405 => 'Method Not Allowed',
        406 => 'Not Acceptable',
        407 => 'Proxy Authentication Required',
        408 => 'Request Timeout',
        409 => 'Conflict',
        410 => 'Gone',
        411 => 'Length Required',
        412 => 'Precondition Failed',
        413 => 'Payload Too Large',
        414 => 'URI Too Long',
        415 => 'Unsupported Media Type',
        416 => 'Range Not Satisfiable',
        417 => 'Expectation Failed',
        418 => 'I\'m a teapot',                                               // RFC2324
        421 => 'Misdirected Request',                                         // RFC7540
        422 => 'Unprocessable Entity',                                        // RFC4918
        423 => 'Locked',                                                      // RFC4918
        424 => 'Failed Dependency',                                           // RFC4918
        425 => 'Too Early',                                                   // RFC-ietf-httpbis-replay-04
        426 => 'Upgrade Required',                                            // RFC2817
        428 => 'Precondition Required',                                       // RFC6585
        429 => 'Too Many Requests',                                           // RFC6585
        431 => 'Request Header Fields Too Large',                             // RFC6585
        451 => 'Unavailable For Legal Reasons',                               // RFC7725
        500 => 'Internal Server Error',
        501 => 'Not Implemented',
        502 => 'Bad Gateway',
        503 => 'Service Unavailable',
        504 => 'Gateway Timeout',
        505 => 'HTTP Version Not Supported',
        506 => 'Variant Also Negotiates',                                     // RFC2295
        507 => 'Insufficient Storage',                                        // RFC4918
        508 => 'Loop Detected',                                               // RFC5842
        510 => 'Not Extended',                                                // RFC2774
        511 => 'Network Authentication Required',                             // RFC6585
    ];


    public function __construct(string $body, int $status = 200)
    {
        $this->status = $status;
        $this->body = $body;

        $this->setHeader('Content-Type', 'text/html; charset=utf-8');
        $this->setHeader('Date', gmdate('D, d M Y H:i:s'));
        $this->setHeader('Server', 'PHP-WebServer');
    }

    public static function message(int $status): self
    {
        return new static ("<h1>PHP-WebServer: " . $status . ' - ' . self::$statusMsg[$status] . "</h1>", $status);
    }

    public function setHeader(string $key, string $value): void
    {
        $this->headers[ucfirst($key)] = $value;
    }

    /**
     * Build string of header
     */
    public function headerString(): string
    {
        $lines[] = 'HTTP/1.1 ' . $this->status . ' ' . self::$statusMsg[$this->status];

        foreach ($this->headers as $key => $value) {
            $lines[] = "{$key}: {$value}";
        }

        return implode(" \r\n", $lines) . "\r\n\r\n";
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function getBody(): string
    {
        return $this->body;
    }

    public function __toString(): string
    {
        return $this->headerString() . $this->getBody();
    }
}