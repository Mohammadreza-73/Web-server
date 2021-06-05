<?php

namespace WebServer;

use InvalidArgumentException;
use WebServer\Exceptions\SocketBindException;
use WebServer\Exceptions\SocketCreateException;

class Server
{
    private string $host;
    private int $port;
    private $socket;

    public function __construct(string $host, int $port)
    {
        $this->host = $host;
        $this->port = $port;

        $this->socketCreate();
        $this->socketBind();
    }

    public function socketCreate(): void
    {
        if (! $this->socket = socket_create(AF_INET, SOCK_STREAM, 0) )
            throw new SocketCreateException('Could not create socket: ' . socket_strerror( socket_last_error() ));
    }

    public function socketBind(): void
    {
        if (! socket_bind($this->socket, $this->host, $this->port) )
            throw new SocketBindException('Could not Bind ' . $this->host . ':' . $this->port . ' - ' . socket_strerror( socket_last_error() ));
    }

    public function socketListen(callable $callback)
    {
        if (! is_callable($callback) )
            throw new InvalidArgumentException('Argument should be a callable');

        while (true) {
            socket_listen($this->socket);

            if (! $client = socket_accept($this->socket) ) {
                socket_close($this->socket); continue;
            }

            /** Parse header and extract Method, Uri, Params */
            $request = new Request( socket_read($client, 4096) );

            $response = call_user_func($callback, $request);

            if (! $response || ! $response instanceof Response)
                $response = Response::message(404);

            socket_write( $client, $response, strlen($response) );
            socket_close($client);
        }
    }
}