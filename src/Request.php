<?php

namespace WebServer;

use WebServer\Exceptions\BufferOverFlowException;

class Request
{
    private string $method = 'GET';
    private string $uri;
    private array $headers = [];
    private array $params = [];
    public int $buffer_max_size = 4096;

    public function __construct(string $header)
    {
        $this->parseHeader($header);
    }

    public function parseHeader(string $header): void
    {
        if ( strlen($header) > (int) $this->buffer_max_size )
            throw new BufferOverFlowException(
                'Maximum buffer size of ' . $this->buffer_max_size . ' exceeded parsing HTTP header'
            );

        $lines = explode("\r\n", $header);
        
        list($this->method, $this->uri) = explode(' ', array_shift($lines));

        preg_match('/(\?)((\S*)*)/', $header, $params);
        $params = @explode('&', $params[2]);

        foreach ($params as $param) {
            /** IGNORE NOTICE: Query parameters not exists */
            @list($keys[], $values[]) = explode('=', $param);
        }
        $this->params = array_combine($keys, $values);

        foreach ($lines as $line) {
            $line = trim($line);

            if ( strpos($line, ': ') !== false ) {
                list($key , $value) = explode(': ', $line);
                $this->headers[$key] = $value;
            }
        }
    }

    public function getMethod(): string
    {
        return $this->method;
    }

    public function getUri(): string
    {
        return $this->uri;
    }

    public function getHeaders(): array
    {
        return $this->headers;
    }

    public function getParams(): array
    {
        return $this->params;
    }
}