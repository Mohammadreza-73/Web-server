<?php

namespace Tests\Unit;

use WebServer\Response;
use PHPUnit\Framework\TestCase;

class ResponseTest extends TestCase
{
    public function setUp(): void
    {
        $this->response = new Response('response message', 200);
        parent::setUp();
    }

    public function testMessageMethodInstanceOfResponse(): void
    {
        $this->assertInstanceOf(Response::class, $this->response->message(200));
    }

    public function testItCanGetHeaderString(): void
    {
        $this->assertIsString($this->response->headerString());
        $this->assertStringContainsString("\r\n", $this->response->headerString());
    }

    public function testItCanGetUri(): void
    {
        $this->assertIsInt($this->response->getStatus());
    }

    public function testItCanGetBody(): void
    {
        $this->assertIsString($this->response->getBody());
    }
}