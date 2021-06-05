<?php

namespace Tests\Unit;

use WebServer\Request;
use PHPUnit\Framework\TestCase;
use WebServer\Exceptions\BufferOverFlowException;

class RequestTest extends TestCase
{
    public function setUp(): void
    {
        $this->request = new Request("GET /some-uri?name=dummy&skill=PHP HTTP/1.1\r\nHost: localhost");
        parent::setUp();
    }

    public function testExpectBufferOverFlowResponse(): void
    {
        $this->expectException(BufferOverFlowException::class);

        $this->request->buffer_max_size = 10;
        $this->request->parseHeader("GET /some-uri?name=dummy&skill=PHP HTTP/1.1\r\nHost: localhost");
    }

    public function testItCanGetMethod(): void
    {
        $this->assertIsString($this->request->getMethod());
        $this->assertEquals('GET', $this->request->getMethod());
    }

    public function testItCanGetUri(): void
    {
        $this->assertNotEmpty($this->request->getUri());
        $this->assertIsString($this->request->getUri());
    }

    public function testItCanGetHeaders(): void
    {
        $this->assertNotNull($this->request->getHeaders());
        $this->assertIsArray($this->request->getHeaders());
    }

    public function testItCanGetParams(): void
    {
        $this->assertNotNull($this->request->getParams());
        $this->assertIsArray($this->request->getParams());
    }
}
