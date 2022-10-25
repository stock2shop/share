<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class OrderItemTest extends TestCase
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
            "total_discount": 20.05
        }';
    }

    public function testSerialize(): void
    {
        $m = DTO\OrderItem::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\OrderItem::createFromJSON($this->json);
        $this->assertOrderItem($m);
    }

    private function assertOrderItem(DTO\OrderItem $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderItem', $c);
    }
}
