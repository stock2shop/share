<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemOrderItemTaxTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
       {
            "price": 19.99,
            "rate": 15,
            "client_id": 21,
            "code": "x",
            "created": "created",
            "modified": "modified",
            "order_item_id": 1,
            "title": "VAT"
        }';
    }

    public function testSerialize(): void
    {
        $m = DTO\SystemOrderItemTax::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\SystemOrderItemTax::createFromJSON($this->json);
        $this->assertSystemOrderItemTax($m);
    }

    private function assertSystemOrderItemTax(DTO\SystemOrderItemTax $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderItemTax', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemOrderItemTax', $c);
    }
}
