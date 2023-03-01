<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemOrderShippingLineTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "id": 1,
            "price": 99.99,
            "title": "title",
            "created": "created",
            "modified": "modified",
            "price_display": "price_display",
            "sub_total": 3.01,
            "sub_total_display": "sub_total_display",
            "tax": 4.02,
            "tax_lines": [
                {
                    "code": "ABC",
                    "price": 19.99,
                    "rate": 19.99,
                    "title": "title"
                }
            ],
            "tax_display": "tax_display",
            "tax_per_unit": 5.03,
            "tax_per_unit_display": "tax_per_unit_display",
            "total": 6.04,
            "total_discount": 7.05,
            "total_discount_display": "total_discount_display",
            "total_display": "total_display"
        }';
    }

    public function testSerialize(): void
    {
        $m          = DTO\SystemOrderShippingLine::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\SystemOrderShippingLine::createFromJSON($this->json);
        $this->assertSystemOrderShippingLine($m);
    }

    private function assertSystemOrderShippingLine(DTO\SystemOrderShippingLine $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderShippingLine', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemOrderShippingLine', $c);
    }
}
