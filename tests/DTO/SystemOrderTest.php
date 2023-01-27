<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\SystemOrder;

class SystemOrderTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "channel_id" => 56,
            "channel_order_code" => "91",
            "notes" => null,
            "total_discount" => null,
            "state" => "",
            "client_id"=> null,
            "created" => "",
            "customer" => [
                "accepts_marketing" => false,
                "email" => "email_address",
                "first_name" => "first_name",
                "last_name" => "last_name",
                "active" => false,
                "addresses" => [[
                    "address1" => "14 Tracy Close",
                    "address2" => "",
                    "city" => "Cape Town",
                    "company" => "",
                    "country" => "South Africa",
                    "country_code" => "ZA",
                    "first_name" => "Keenan",
                    "last_name" => "",
                    "phone" => "",
                    "province" => "Western Province",
                    "province_code" => "WP",
                    "type" => "",
                    "zip" => "7785"
                ]],
                "channel_customer_code" => "",
                "channel_id" => null,
                "client_id" => null,
                "created" => "",
                "customer_id" => null,
                "meta" => [[
                    "key" => "key",
                    "value" => "value",
                    "template_name" => ""
                ]],
                "modified" => "",
                "user" => [
                    "customer_id" => null,
                    "id" => null,
                    "segments" => [[
                        "type" => "products",
                        "key" => "vendor",
                        "operator" => "contains",
                        "value" => "Mihoyo",
                        "owner" => "system"
                    ]],
                    "price_tier" => "",
                    "qty_availability" => ""
                ]
            ],
            "fulfillments" => [[
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
                "line_items" => [[
                    "grams" => 0,
                    "qty" => 5,
                    "sku" => "sku",
                    "fulfilled_qty" => null,
                    "created" => "created_date",
                    "modified" => "modified_date"
                ]],
                "modified" => "",
                "order_id" => 9000,
                "shipping_address" => [
                    "address1" => "14 Tracy Close",
                    "address2" => "",
                    "city" => "Cape Town",
                    "company" => "",
                    "country" => "South Africa",
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
            ]],
            "history" => [[
                "instruction" => "",
                "storage_code" => "",
                "created" => "",
                "modified" => ""
            ]],
            "id" => null,
            "line_item_sub_total" => null,
            "line_item_tax" => null,
            "line_items" => [[
                "barcode" => null,
                "grams" => null,
                "price" => null,
                "qty" => null,
                "sku" => "sku",
                "title" => null,
                "total_discount" => null,
                "created" => "",
                "fulfillments" => [[
                    "grams" => null,
                    "qty" => null,
                    "sku" => null,
                    "fulfilled_qty" => null,
                    "created" => "",
                    "modified" => null
                ]],
                "modified" => null,
                "product_id" => null,
                "variant_id" => null,
                "source_id" => null,
                "source_variant_code" => null,
                "price_display" => null,
                "total_discount_display" => null,
                "tax_per_unit_display" => null,
                "tax" => null,
                "tax_display" => null,
                "sub_total" => null,
                "tax_per_unit" => null,
                "sub_total_display" => null,
                "total" => null,
                "total_display" => null
            ]],
            "meta" => [[
                "key" => "",
                "value" => ""
            ]],
            "modified" => "date",
            "shipping_lines" => [[
                "price" => null,
                "title" => null,
                "created" => "",
                "modified" => "",
                "price_display" => null,
                "sub_total" => null,
                "sub_total_display" => null,
                "tax" => null,
                "tax_display" => null,
                "tax_per_unit" => null,
                "tax_per_unit_display" => null,
                "total" => null,
                "total_discount" => null,
                "total_discount_display" => null,
                "total_display" => null
            ]],
            "shipping_sub_total" => null,
            "shipping_tax" => null,
            "shipping_tax_display" => null,
            "shipping_total" => null,
            "shipping_total_display" => null,
            "sources" => [[
                "source_id" => null,
                "source_customer_code" => null,
                "source_order_code" => null
            ]],
            "status" => null,
            "sub_total" => null,
            "sub_total_display" => null,
            "tax" => null,
            "tax_display" => null,
            "total" => null,
            "total_discount_display" => null,
            "total_display" => null
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "channel_id": 56,
            "channel_order_code": "91",
            "notes": null,
            "total_discount": null,
            "state": "",
            "client_id": null,
            "created": "",
            "customer": {
                "accepts_marketing": false,
                "email": "email_address",
                "first_name": "first_name",
                "last_name": "last_name",
                "active": false,
                "addresses": [{
                    "address1": "14 Tracy Close",
                    "address2": "",
                    "city": "Cape Town",
                    "company": "",
                    "country": "South Africa",
                    "country_code": "ZA",
                    "first_name": "Keenan",
                    "last_name": "",
                    "phone": "",
                    "province": "Western Province",
                    "province_code": "WP",
                    "type": "",
                    "zip": "7785"
                }],
                "channel_customer_code": "",
                "channel_id": null,
                "client_id": null,
                "created": "",
                "customer_id": null,
                "meta": [{
                    "key": "key",
                    "value": "value",
                    "template_name": ""
                }],
                "modified": "",
                "user": {
                    "customer_id": null,
                    "id": null,
                    "segments": [{
                        "type": "products",
                        "key": "vendor",
                        "operator": "contains",
                        "value": "Mihoyo",
                        "owner": "system"
                    }],
                    "price_tier": "",
                    "qty_availability": ""
                }
            },
            "fulfillments": [{
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
                "line_items": [{
                    "grams": 0,
                    "qty": 5,
                    "sku": "sku",
                    "fulfilled_qty": null,
                    "created": "created_date",
                    "modified": "modified_date"
                }],
                "modified": "",
                "order_id": 9000,
                "shipping_address": {
                    "address1": "14 Tracy Close",
                    "address2": "",
                    "city": "Cape Town",
                    "company": "",
                    "country": "South Africa",
                    "country_code": "ZA",
                    "first_name": "Keenan",
                    "last_name": "",
                    "phone": "",
                    "province": "Western Province",
                    "province_code": "WP",
                    "type": "",
                    "zip": "7785",
                    "channel_id": null,
                    "client_id": null,
                    "created": "",
                    "modified": ""
                },
                "state": "",
                "channel_synced": ""
            }],
            "history": [{
                "instruction": "",
                "storage_code": "",
                "created": "",
                "modified": ""
            }],
            "id": null,
            "line_item_sub_total": null,
            "line_item_tax": null,
            "line_items": [{
                "barcode": null,
                "grams": null,
                "price": null,
                "qty": null,
                "sku": "sku",
                "title": null,
                "total_discount": null,
                "created": "",
                "fulfillments": [{
                    "grams": null,
                    "qty": null,
                    "sku": null,
                    "fulfilled_qty": null,
                    "created": "",
                    "modified": null
                }],
                "modified": null,
                "product_id": null,
                "variant_id": null,
                "source_id": null,
                "source_variant_code": null,
                "price_display": null,
                "total_discount_display": null,
                "tax_per_unit_display": null,
                "tax": null,
                "tax_display": null,
                "sub_total": null,
                "tax_per_unit": null,
                "sub_total_display": null,
                "total": null,
                "total_display": null
            }],
            "meta": [{
                "key": "",
                "value": ""
            }],
            "modified": "date",
            "shipping_lines": [{
                "price": null,
                "title": null,
                "created": "",
                "modified": "",
                "price_display": null,
                "sub_total": null,
                "sub_total_display": null,
                "tax": null,
                "tax_display": null,
                "tax_per_unit": null,
                "tax_per_unit_display": null,
                "total": null,
                "total_discount": null,
                "total_discount_display": null,
                "total_display": null
            }],
            "shipping_sub_total": null,
            "shipping_tax": null,
            "shipping_tax_display": null,
            "shipping_total": null,
            "shipping_total_display": null,
            "sources": [{
                "source_id": null,
                "source_customer_code": null,
                "source_order_code": null
            }],
            "status": null,
            "sub_total": null,
            "sub_total_display": null,
            "tax": null,
            "tax_display": null,
            "total": null,
            "total_discount_display": null,
            "total_display": null
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new SystemOrder($this->setUpArray());

        $this->assertSame(56, $object->channel_id);
        $this->assertSame("91", $object->channel_order_code);
        $this->assertSame("", $object->created);
        $this->assertSame(null, $object->id);
        $this->assertSame(null, $object->line_item_sub_total);
        $this->assertSame(null, $object->line_item_tax);
        $this->assertSame("date", $object->modified);
        $this->assertSame(null, $object->shipping_sub_total);
        $this->assertSame(null, $object->total_discount_display);
        $this->assertSame(null, $object->total_display);
        $this->assertSame("email_address", $object->customer->email);
        $this->assertSame("14 Tracy Close", $object->customer->addresses[0]->address1);
        $this->assertSame("notes", $object->fulfillments[0]->notes);
        $this->assertSame("sku", $object->line_items[0]->sku);
        $this->assertSame(null, $object->shipping_lines[0]->price);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemOrder", $object);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemCustomer", $object->customer);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemOrderHistory", $object->history[0]);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemOrderItem", $object->line_items[0]);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\OrderMeta", $object->meta[0]);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemOrderShippingLine", $object->shipping_lines[0]);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\OrderSource", $object->sources[0]);

        $object_attributes = 
        [
            "channel_id",
            "client_id",
            "created",
            "id",
            "line_item_sub_total",
            "line_item_tax",
            "modified",
            "shipping_sub_total",
            "total_discount_display",
            "total_display",
            "status",
            "sub_total",
            "tax",
            "tax_display",
            "total",
            "shipping_tax"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void
    { 
        $array = SystemOrder::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(SystemOrder::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "channel_id" => 56,
                "channel_order_code" => "91",
                "notes" => null,
                "total_discount" => null,
                "state" => "",
                "client_id"=> null,
                "created" => "",
                "customer" => [
                    "accepts_marketing" => false,
                    "email" => "email_address",
                    "first_name" => "first_name",
                    "last_name" => "last_name",
                    "active" => false,
                    "addresses" => [[
                        "address1" => "14 Tracy Close",
                        "address2" => "",
                        "city" => "Cape Town",
                        "company" => "",
                        "country" => "South Africa",
                        "country_code" => "ZA",
                        "first_name" => "Keenan",
                        "last_name" => "",
                        "phone" => "",
                        "province" => "Western Province",
                        "province_code" => "WP",
                        "type" => "",
                        "zip" => "7785"
                    ]],
                    "channel_customer_code" => "",
                    "channel_id" => null,
                    "client_id" => null,
                    "created" => "",
                    "customer_id" => null,
                    "meta" => [[
                        "key" => "key",
                        "value" => "value",
                        "template_name" => ""
                    ]],
                    "modified" => "",
                    "user" => [
                        "customer_id" => null,
                        "id" => null,
                        "segments" => [[
                            "type" => "products",
                            "key" => "vendor",
                            "operator" => "contains",
                            "value" => "Mihoyo",
                            "owner" => "system"
                        ]],
                        "price_tier" => "",
                        "qty_availability" => ""
                    ]
                ],
                "fulfillments" => [[
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
                    "line_items" => [[
                        "grams" => 0,
                        "qty" => 5,
                        "sku" => "sku",
                        "fulfilled_qty" => null,
                        "created" => "created_date",
                        "modified" => "modified_date"
                    ]],
                    "modified" => "",
                    "order_id" => 9000,
                    "shipping_address" => [
                        "address1" => "14 Tracy Close",
                        "address2" => "",
                        "city" => "Cape Town",
                        "company" => "",
                        "country" => "South Africa",
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
                ]],
                "history" => [[
                    "instruction" => "",
                    "storage_code" => "",
                    "created" => "",
                    "modified" => ""
                ]],
                "id" => null,
                "line_item_sub_total" => null,
                "line_item_tax" => null,
                "line_items" => [[
                    "barcode" => null,
                    "grams" => null,
                    "price" => null,
                    "qty" => null,
                    "sku" => "sku",
                    "title" => null,
                    "total_discount" => null,
                    "created" => "",
                    "fulfillments" => [[
                        "grams" => null,
                        "qty" => null,
                        "sku" => null,
                        "fulfilled_qty" => null,
                        "created" => "",
                        "modified" => null
                    ]],
                    "modified" => null,
                    "product_id" => null,
                    "variant_id" => null,
                    "source_id" => null,
                    "source_variant_code" => null,
                    "price_display" => null,
                    "total_discount_display" => null,
                    "tax_per_unit_display" => null,
                    "tax" => null,
                    "tax_display" => null,
                    "sub_total" => null,
                    "tax_per_unit" => null,
                    "sub_total_display" => null,
                    "total" => null,
                    "total_display" => null
                ]],
                "meta" => [[
                    "key" => "",
                    "value" => ""
                ]],
                "modified" => "date",
                "shipping_lines" => [[
                    "price" => null,
                    "title" => null,
                    "created" => "",
                    "modified" => "",
                    "price_display" => null,
                    "sub_total" => null,
                    "sub_total_display" => null,
                    "tax" => null,
                    "tax_display" => null,
                    "tax_per_unit" => null,
                    "tax_per_unit_display" => null,
                    "total" => null,
                    "total_discount" => null,
                    "total_discount_display" => null,
                    "total_display" => null
                ]],
                "shipping_sub_total" => null,
                "shipping_tax" => null,
                "shipping_tax_display" => null,
                "shipping_total" => null,
                "shipping_total_display" => null,
                "sources" => [[
                    "source_id" => null,
                    "source_customer_code" => null,
                    "source_order_code" => null
                ]],
                "status" => null,
                "sub_total" => null,
                "sub_total_display" => null,
                "tax" => null,
                "tax_display" => null,
                "total" => null,
                "total_discount_display" => null,
                "total_display" => null
            ],
            [
                "channel_id" => 56,
                "channel_order_code" => "91",
                "notes" => null,
                "total_discount" => null,
                "state" => "",
                "client_id"=> null,
                "created" => "",
                "customer" => [
                    "accepts_marketing" => false,
                    "email" => "email_address",
                    "first_name" => "first_name",
                    "last_name" => "last_name",
                    "active" => false,
                    "addresses" => [[
                        "address1" => "14 Tracy Close",
                        "address2" => "",
                        "city" => "Cape Town",
                        "company" => "",
                        "country" => "South Africa",
                        "country_code" => "ZA",
                        "first_name" => "Keenan",
                        "last_name" => "",
                        "phone" => "",
                        "province" => "Western Province",
                        "province_code" => "WP",
                        "type" => "",
                        "zip" => "7785"
                    ]],
                    "channel_customer_code" => "",
                    "channel_id" => null,
                    "client_id" => null,
                    "created" => "",
                    "customer_id" => null,
                    "meta" => [[
                        "key" => "key",
                        "value" => "value",
                        "template_name" => ""
                    ]],
                    "modified" => "",
                    "user" => [
                        "customer_id" => null,
                        "id" => null,
                        "segments" => [[
                            "type" => "products",
                            "key" => "vendor",
                            "operator" => "contains",
                            "value" => "Mihoyo",
                            "owner" => "system"
                        ]],
                        "price_tier" => "",
                        "qty_availability" => ""
                    ]
                ],
                "fulfillments" => [[
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
                    "line_items" => [[
                        "grams" => 0,
                        "qty" => 5,
                        "sku" => "sku",
                        "fulfilled_qty" => null,
                        "created" => "created_date",
                        "modified" => "modified_date"
                    ]],
                    "modified" => "",
                    "order_id" => 9000,
                    "shipping_address" => [
                        "address1" => "14 Tracy Close",
                        "address2" => "",
                        "city" => "Cape Town",
                        "company" => "",
                        "country" => "South Africa",
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
                ]],
                "history" => [[
                    "instruction" => "",
                    "storage_code" => "",
                    "created" => "",
                    "modified" => ""
                ]],
                "id" => null,
                "line_item_sub_total" => null,
                "line_item_tax" => null,
                "line_items" => [[
                    "barcode" => null,
                    "grams" => null,
                    "price" => null,
                    "qty" => null,
                    "sku" => "sku",
                    "title" => null,
                    "total_discount" => null,
                    "created" => "",
                    "fulfillments" => [[
                        "grams" => null,
                        "qty" => null,
                        "sku" => null,
                        "fulfilled_qty" => null,
                        "created" => "",
                        "modified" => null
                    ]],
                    "modified" => null,
                    "product_id" => null,
                    "variant_id" => null,
                    "source_id" => null,
                    "source_variant_code" => null,
                    "price_display" => null,
                    "total_discount_display" => null,
                    "tax_per_unit_display" => null,
                    "tax" => null,
                    "tax_display" => null,
                    "sub_total" => null,
                    "tax_per_unit" => null,
                    "sub_total_display" => null,
                    "total" => null,
                    "total_display" => null
                ]],
                "meta" => [[
                    "key" => "",
                    "value" => ""
                ]],
                "modified" => "date",
                "shipping_lines" => [[
                    "price" => null,
                    "title" => null,
                    "created" => "",
                    "modified" => "",
                    "price_display" => null,
                    "sub_total" => null,
                    "sub_total_display" => null,
                    "tax" => null,
                    "tax_display" => null,
                    "tax_per_unit" => null,
                    "tax_per_unit_display" => null,
                    "total" => null,
                    "total_discount" => null,
                    "total_discount_display" => null,
                    "total_display" => null
                ]],
                "shipping_sub_total" => null,
                "shipping_tax" => null,
                "shipping_tax_display" => null,
                "shipping_total" => null,
                "shipping_total_display" => null,
                "sources" => [[
                    "source_id" => null,
                    "source_customer_code" => null,
                    "source_order_code" => null
                ]],
                "status" => null,
                "sub_total" => null,
                "sub_total_display" => null,
                "tax" => null,
                "tax_display" => null,
                "total" => null,
                "total_discount_display" => null,
                "total_display" => null
            ]
        ];

        $json = json_encode(SystemOrder::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    // /** @dataProvider computeHash */
    // public function testComputeHash(array $systemOrder, string $expectedValue): void 
    // {
    //     $system_order = new SystemOrder($systemOrder);
    //     $this->assertEquals($expectedValue, $system_order->computeHash());
    // }

    // /** @dataProvider computeHash_null */
    // public function testComputeHash_null(array $systemOrders, string $expectedValue): void 
    // {
    //     foreach($systemOrders as $systemOrder)
    //     {
    //         $system_order = new SystemOrder($systemOrder);
    //         $this->assertEquals($expectedValue, $system_order->computeHash());
    //     }
    // }

    private function computeHash(): array 
    { 
        return [
            [
                [
                    "channel_id" => 56,
                    "channel_order_code" => "91",
                    "notes" => null,
                    "total_discount" => null,
                    "state" => "",
                    "client_id"=> null
                ],
                ""
            ],
            [
                [
                    "channel_id" => 56,
                    "channel_order_code" => "91",
                    "notes" => null,
                    "total_discount" => null,
                    "state" => ""
                ],
                ""
            ],
            [
                [
                    "total_discount" => null,
                    "channel_order_code" => "91",
                    "channel_id" => 56,
                    "state" => "",
                    "notes" => null
                ],
                ""
            ],
            [
                [
                    "channel_id" => 56,
                    "channel_order_code" => "91",
                    "notes" => null,
                    "total_discount" => null,
                    "state" => "",
                    "client_id"=> null,
                    "created" => "",
                    "customer" => [
                        "accepts_marketing" => false,
                        "email" => "email_address",
                        "first_name" => "first_name",
                        "last_name" => "last_name",
                        "active" => false,
                        "addresses" => [[
                            "address1" => "14 Tracy Close",
                            "address2" => "",
                            "city" => "Cape Town",
                            "company" => "",
                            "country" => "South Africa",
                            "country_code" => "ZA",
                            "first_name" => "Keenan",
                            "last_name" => "",
                            "phone" => "",
                            "province" => "Western Province",
                            "province_code" => "WP",
                            "type" => "",
                            "zip" => "7785"
                        ]],
                        "channel_customer_code" => "",
                        "channel_id" => null,
                        "client_id" => null,
                        "created" => "",
                        "customer_id" => null,
                        "meta" => [[
                            "key" => "key",
                            "value" => "value",
                            "template_name" => ""
                        ]],
                        "modified" => "",
                        "user" => [
                            "customer_id" => null,
                            "id" => null,
                            "segments" => [[
                                "type" => "products",
                                "key" => "vendor",
                                "operator" => "contains",
                                "value" => "Mihoyo",
                                "owner" => "system"
                            ]],
                            "price_tier" => "",
                            "qty_availability" => ""
                        ]
                    ],
                    "fulfillments" => [[
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
                        "line_items" => [[
                            "grams" => 0,
                            "qty" => 5,
                            "sku" => "sku",
                            "fulfilled_qty" => null,
                            "created" => "created_date",
                            "modified" => "modified_date"
                        ]],
                        "modified" => "",
                        "order_id" => 9000,
                        "shipping_address" => [
                            "address1" => "14 Tracy Close",
                            "address2" => "",
                            "city" => "Cape Town",
                            "company" => "",
                            "country" => "South Africa",
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
                    ]],
                    "history" => [[
                        "instruction" => "",
                        "storage_code" => "",
                        "created" => "",
                        "modified" => ""
                    ]],
                    "id" => null,
                    "line_item_sub_total" => null,
                    "line_item_tax" => null,
                    "line_items" => [[
                        "barcode" => null,
                        "grams" => null,
                        "price" => null,
                        "qty" => null,
                        "sku" => "sku",
                        "title" => null,
                        "total_discount" => null,
                        "created" => "",
                        "fulfillments" => [[
                            "grams" => null,
                            "qty" => null,
                            "sku" => null,
                            "fulfilled_qty" => null,
                            "created" => "",
                            "modified" => null
                        ]],
                        "modified" => null,
                        "product_id" => null,
                        "variant_id" => null,
                        "source_id" => null,
                        "source_variant_code" => null,
                        "price_display" => null,
                        "total_discount_display" => null,
                        "tax_per_unit_display" => null,
                        "tax" => null,
                        "tax_display" => null,
                        "sub_total" => null,
                        "tax_per_unit" => null,
                        "sub_total_display" => null,
                        "total" => null,
                        "total_display" => null
                    ]],
                    "meta" => [[
                        "key" => "",
                        "value" => ""
                    ]],
                    "modified" => "date",
                    "shipping_lines" => [[
                        "price" => null,
                        "title" => null,
                        "created" => "",
                        "modified" => "",
                        "price_display" => null,
                        "sub_total" => null,
                        "sub_total_display" => null,
                        "tax" => null,
                        "tax_display" => null,
                        "tax_per_unit" => null,
                        "tax_per_unit_display" => null,
                        "total" => null,
                        "total_discount" => null,
                        "total_discount_display" => null,
                        "total_display" => null
                    ]],
                    "shipping_sub_total" => null,
                    "shipping_tax" => null,
                    "shipping_tax_display" => null,
                    "shipping_total" => null,
                    "shipping_total_display" => null,
                    "sources" => [[
                        "source_id" => null,
                        "source_customer_code" => null,
                        "source_order_code" => null
                    ]],
                    "status" => null,
                    "sub_total" => null,
                    "sub_total_display" => null,
                    "tax" => null,
                    "tax_display" => null,
                    "total" => null,
                    "total_discount_display" => null,
                    "total_display" => null
                    
                ],
                ""
            ]
        ];
    }

    private function computeHash_null(): array 
    { 
        return [
            [
                [
                    [],
                    [
                        "channel_id" => null,
                        "channel_order_code" => null,
                        "notes" => null,
                        "total_discount" => null,
                        "state" => null,
                        "client_id"=> null
                    ]
                ],
                ""
            ]
        ];
    }
    
}

?>