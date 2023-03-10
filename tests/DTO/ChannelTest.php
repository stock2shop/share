<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '{
          "id": 1,
          "active": true,
          "client_id": 21,
          "created": "2022-09-13 09:13:39",
          "modified": "2022-09-13 09:13:39",
          "price_tier": "A",
          "description": "testChannel",
          "qty_availability": "wholesale",
          "sync_token": "1",
          "type": "trade",
          "meta": [
            {
              "key": "size",
              "value": "12",
              "template_name": "template_a"
            }
          ]
        }';
    }

    public function testSerialize(): void
    {
        $chan = DTO\Channel::createFromJSON($this->json);
        $serialized = json_encode($chan);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $c = DTO\Channel::createFromJSON($this->json);
        $this->assertChannel($c);
    }

    private function assertChannel(DTO\Channel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Channel', $c);
        $this->assertEquals(true, $c->active);
        foreach ($c->meta as $meta) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $meta);
        }
    }
}
