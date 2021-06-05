<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use WebServer\Exceptions\SocketCreateException;

class ServerTest extends TestCase
{
    public function testExpectSocketCreateException(): void
    {
        $this->expectException(SocketCreateException::class);

        $socket = socket_create(AF_INET, SOCK_STREAM, 0);
    }
}