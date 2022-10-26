<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemFulfillmentLineItemTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "channel_id": 57,
            "client_id": 21,
            "created": "created",
            "modified": "modified",
            "grams": 10,
            "qty": 1,
            "sku": "sku",
            "fulfilled_qty": 0
        }';
    }

    public function testSerialize(): void
    {
        $m          = DTO\SystemFulfillmentLineItem::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\SystemFulfillmentLineItem::createFromJSON($this->json);
        $this->assertSystemFulfillmentLineItem($m);
    }

    private function assertSystemFulfillmentLineItem(DTO\SystemFulfillmentLineItem $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemFulfillmentLineItem', $c);
    }
}
