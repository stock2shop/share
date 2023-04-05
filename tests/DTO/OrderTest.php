<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class OrderTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "channel_id": 20,
            "channel_order_code": "channel_order_code",
            "notes": "notes",
            "ordered_date": "1970-01-01 00:00:00",
            "total_discount": 20.05
        }';
    }

    public function testSerialize(): void
    {
        $m = DTO\Order::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\Order::createFromJSON($this->json);
        $this->assertOrder($m);
    }

    private function assertOrder(DTO\Order $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Order', $c);
    }
}
