<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class FulfillmentLineItemTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "grams": 10,
            "qty": 1,
            "sku": "sku",
            "fulfilled_qty": 0
        }';
    }

    public function testSerialize(): void
    {
        $m          = DTO\FulfillmentLineItem::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\FulfillmentLineItem::createFromJSON($this->json);
        $this->assertFulfillmentLineItem($m);
    }

    private function assertFulfillmentLineItem(DTO\FulfillmentLineItem $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\FulfillmentLineItem', $c);
    }
}
