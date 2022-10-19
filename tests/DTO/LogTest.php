<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class LogTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '{
            "channel_id": 1,
            "client_id": 21,
            "created": "2022-01-01 12:12:01.000001",
            "ip": "21.21.21.21",
            "log_to_es": false,
            "level": "error",
            "message": "A message",
            "method": null,
            "metric": 1.23,
            "origin": "Connector",
            "remote_addr": "129.168.0.1",
            "request_path": "/some/path",
            "source_id": 123,
            "tags": ["x", "y"],
            "trace": ["a", "b"],
            "user_id": null,
            "context": [
                {
                    "key": "foo",
                    "value": "bar"
                }
            ]
        }';
    }

    public function testSerialize(): void
    {
        $log = DTO\Log::createFromJSON($this->json);
        $serialized = json_encode($log);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $c = DTO\Log::createFromJSON($this->json);
        $this->assertLog($c);
        $c = new DTO\Log([
            'client_id' => 21,
            'log_to_es' => true,
            'level' => 'info',
            'message' => 'x',
            'origin' => 'y',
        ]);
        $this->assertLogNull($c);
    }

    private function assertLog(DTO\Log $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Log', $c);
        $this->assertIsArray($c->tags);
        $this->assertIsArray($c->trace);
        $this->assertIsArray($c->context);
    }

    private function assertLogNull(DTO\Log $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Log', $c);
        $this->assertEmpty($c->tags);
        $this->assertEmpty($c->trace);
        $this->assertEmpty($c->context);
    }
}
