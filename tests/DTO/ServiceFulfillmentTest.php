<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ServiceFulfillmentTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "fulfillmentservice_order_code": "fulfillmentservice_order_code",
            "line_items": [
                {
                    "grams": 10,
                    "qty": 1,
                    "sku": "sku",
                    "fulfilled_qty": 0
                }
            ],
            "notes": "notes",
            "status": "status",
            "tracking_company": "tracking_company",
            "tracking_number": 123,
            "tracking_url": "tracking_url"
        }';
    }

    public function testSerialize(): void
    {
        $m = DTO\ServiceFulfillment::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\ServiceFulfillment::createFromJSON($this->json);
        $this->assertServiceFulfillment($m);
    }

    private function assertServiceFulfillment(DTO\ServiceFulfillment $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ServiceFulfillment', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\FulfillmentLineItem', $c->line_items[0]);
    }
}
