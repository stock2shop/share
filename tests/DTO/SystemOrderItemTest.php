<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemOrderItemTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
       {
            "id": 1,
            "barcode": "barcode",
            "grams": 100,
            "price": 19.99,
            "qty": 5,
            "sku": "sku",
            "title": "title",
            "created": "created",
            "fulfillments": [
                {
                    "created": "created",
                    "modified": "modified",
                    "grams": 10,
                    "qty": 1,
                    "sku": "sku",
                    "fulfilled_qty": 0
                }
            ],
            "tax_lines": [
                {
                    "code": "A",
                    "price": 10,
                    "rate": 15,
                    "title": "VAT"
                }
            ],
            "modified": "modified",
            "product_id": 1,
            "variant_id": 2,
            "source_id": 3,
            "source_variant_code": "source_variant_code",
            "price_display": "price_display",
            "total_discount": 4.01,
            "total_discount_display": "total_discount_display",
            "tax_per_unit_display": "tax_per_unit_display",
            "tax": 5.02,
            "tax_display": "tax_display",
            "sub_total": 6.03,
            "tax_per_unit": 7.04,
            "sub_total_display": "sub_total_display",
            "total": 8.05,
            "total_display": "total_display"
        }';
    }

    public function testSerialize(): void
    {
        $m = DTO\SystemOrderItem::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\SystemOrderItem::createFromJSON($this->json);
        $this->assertSystemOrderItem($m);
    }

    private function assertSystemOrderItem(DTO\SystemOrderItem $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderItem', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemOrderItem', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemFulfillmentLineItem', $c->fulfillments[0]);
    }
}
