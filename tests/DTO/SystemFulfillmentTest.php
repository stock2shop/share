<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemFulfillmentTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "channel_synced": "2022-10-27 06:21:41.281236",
            "fulfillmentservice_order_code": "fulfillmentservice_order_code",
            "line_items": [
                {
                    "created": "created",
                    "modified": "modified",
                    "grams": 10,
                    "qty": 1,
                    "sku": "sku",
                    "fulfilled_qty": 0
                }
            ],
            "notes": "notes",
            "state": "state",
            "status": "status",
            "tracking_company": "tracking_company",
            "tracking_number": "tracking_number",
            "tracking_url": "tracking_url",
            "channel_id": 57,
            "client_id": 21,
            "created": "created",
            "fulfillmentservice_id": 1,
            "modified": "modified",
            "order_id": 123,
            "shipping_address": {
                "address1": "address1",
                "address2": "address2",
                "address_code": "address_code",
                "city": "city",
                "company": "company",
                "country": "country",
                "country_code": "country_code",
                "first_name": "first_name",
                "id": 1,
                "last_name": "last_name",
                "phone": "phone",
                "province": "province",
                "province_code": "province_code",
                "type": "type",
                "zip": "zip",
                "channel_id": 57,
                "client_id": 21,
                "created": "created",
                "modified": "modified"
            }
        }';
    }

    public function testSerialize(): void
    {
        $m          = DTO\SystemFulfillment::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\SystemFulfillment::createFromJSON($this->json);
        $this->assertSystemFulfillment($m);
    }

    private function assertSystemFulfillment(DTO\SystemFulfillment $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Fulfillment', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemFulfillment', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\FulfillmentLineItem', $c->line_items[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemFulfillmentLineItem', $c->line_items[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemOrderAddress', $c->shipping_address);
    }
}
