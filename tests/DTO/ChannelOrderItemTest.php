<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelOrderItemTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "barcode": "barcode",
            "grams": 150,
            "price": 19.99,
            "qty": 100,
            "sku": "sku",
            "tax_lines": [
                {
                    "price": 19.99,
                    "title": "title",
                    "rate": 1.2
                }
            ],
            "title": "title",
            "total_discount": 20.05,
            "channel_variant_code": "channel_variant_code"
        }';
    }

    public function testSerialize(): void
    {
        $m = DTO\ChannelOrderItem::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\ChannelOrderItem::createFromJSON($this->json);
        $this->assertChannelOrderItem($m);
    }

    private function assertChannelOrderItem(DTO\ChannelOrderItem $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelOrderItem', $c);
    }
}
