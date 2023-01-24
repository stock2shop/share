<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\SystemFulfillment;

class SystemFulfillmentTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = 
        [
            "fulfillmentservice_order_code" => "",
            "notes" => "notes",
            "status" => "",
            "tracking_company" => "",
            "tracking_number" => "5",
            "tracking_url" => "",
            "channel_id" => "",
            "client_id" => "",
            "created" => "",
            "fulfillmentservice_id" => "",
            "line_items" => 
            [
                [
                    "created" => "created_date",
                    "modified" => "modified_date",
                    "grams" => "0",
                    "qty" => "5",
                    "sku" => "sku",
                    "fulfilled_qty" => ""
                ]
            ],
            "modified" => "",
            "order_id" => "9000",
            "shipping_address" => 
            [
                "address1" => "14 Tracy Close",
                "address2" => "",
                "city" => "Cape Town",
                "country" => "South Africa",
                "company" => "",
                "country_code" => "ZA",
                "first_name" => "Keenan",
                "last_name" => "",
                "phone" => "",
                "province" => "Western Province",
                "province_code" => "WP",
                "type" => "",
                "zip" => "7785",
                "channel_id" => "",
                "client_id" => "",
                "created" => "",
                "modified" => ""
            ],
            "state" => "",
            "channel_synced" => ""
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '
        {
            "fulfillmentservice_order_code": "",
            "notes": "notes",
            "status": "",
            "tracking_company": "",
            "tracking_number": 5,
            "tracking_url": "",
            "channel_id": null,
            "client_id": null,
            "created": "",
            "fulfillmentservice_id": null,
            "line_items": 
            [{
                "created": "created_date",
                "modified": "modified_date",
                "grams": 0,
                "qty": 5,
                "sku": "sku",
                "fulfilled_qty": null
            }],
            "modified": "",
            "order_id": 9000,
            "shipping_address": 
            {
                "address1": "14 Tracy Close",
                "address2": "",
                "city": "Cape Town",
                "country": "",
                "company": "",
                "country_code": "",
                "first_name": "",
                "last_name": "",
                "phone": "",
                "province": "Western Province",
                "province_code": "",
                "type": "",
                "zip": "7785",
                "channel_id": null,
                "client_id": null,
                "created": "",
                "modified": ""
            },
            "state": "",
            "channel_synced": ""
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new SystemFulfillment($this->setUpArray());

        $this->assertSame(null, $object->channel_id);
        $this->assertSame(null, $object->client_id);
        $this->assertSame("", $object->created);
        $this->assertSame(null, $object->fulfillmentservice_id);
        $this->assertSame("sku", $object->line_items[0]->sku);
        $this->assertSame(null, $object->line_items[0]->fulfilled_qty);
        $this->assertSame("", $object->modified);
        $this->assertSame(9000, $object->order_id);
        $this->assertSame("", $object->state);
        $this->assertSame("", $object->channel_synced);
        $this->assertSame("7785", $object->shipping_address->zip);
        $this->assertSame("Western Province", $object->shipping_address->province);
        $this->assertSame("14 Tracy Close", $object->shipping_address->address1);



        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemFulfillment", $object);

        $object_attributes = 
        [
            "channel_id",
            "client_id",
            "created",
            "fulfillmentservice_id",
            "modified",
            "order_id",
            "state",
            "channel_synced"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void 
    { 
        $array = SystemFulfillment::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(SystemFulfillment::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "fulfillmentservice_order_code" => "",
                "notes" => "notes",
                "status" => "",
                "tracking_company" => "",
                "tracking_number" => 5,
                "tracking_url" => "",
                "channel_id" => null,
                "client_id" => null,
                "created" => "",
                "fulfillmentservice_id" => null,
                "line_items" => 
                [
                    [
                        "created" => "created_date",
                        "modified" => "modified_date",
                        "grams" => 0,
                        "qty" => 5,
                        "sku" => "sku",
                        "fulfilled_qty" => null
                    ]
                ],
                "modified" => "",
                "order_id" => 9000,
                "shipping_address" => 
                [
                    "address1" => "14 Tracy Close",
                    "address2" => "",
                    "city" => "Cape Town",
                    "country" => "South Africa",
                    "company" => "",
                    "country_code" => "ZA",
                    "first_name" => "Keenan",
                    "last_name" => "",
                    "phone" => "",
                    "province" => "Western Province",
                    "province_code" => "WP",
                    "type" => "",
                    "zip" => "7785",
                    "channel_id" => null,
                    "client_id" => null,
                    "created" => "",
                    "modified" => ""
                ],
                "state" => "",
                "channel_synced" => ""
            ],
            [
                "fulfillmentservice_order_code" => "",
                "notes" => "notes",
                "status" => "",
                "tracking_company" => "",
                "tracking_number" => 5,
                "tracking_url" => "",
                "channel_id" => null,
                "client_id" => null,
                "created" => "",
                "fulfillmentservice_id" => null,
                "line_items" => 
                [
                    [
                        "created" => "created_date",
                        "modified" => "modified_date",
                        "grams" => 0,
                        "qty" => 10,
                        "sku" => "sku",
                        "fulfilled_qty" => null
                    ]
                ],
                "modified" => "",
                "order_id" => 10,
                "shipping_address" => 
                [
                    "address1" => "14 Tracy Close",
                    "address2" => "",
                    "city" => "Cape Town",
                    "country" => "South Africa",
                    "company" => "",
                    "country_code" => "ZA",
                    "first_name" => "Keenan",
                    "last_name" => "",
                    "phone" => "",
                    "province" => "Western Province",
                    "province_code" => "WP",
                    "type" => "",
                    "zip" => "7785",
                    "channel_id" => null,
                    "client_id" => null,
                    "created" => "",
                    "modified" => ""
                ],
                "state" => "",
                "channel_synced" => ""
            ]
        ];

        $json = json_encode(SystemFulfillment::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>