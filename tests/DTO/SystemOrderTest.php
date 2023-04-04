<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemOrderTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "billing_address": {
                "address1": "abc",
                "address2": null,
                "address_code": "address_code",
                "channel_id": 56,
                "city": "jhb",
                "client_id": 21,
                "country_code": "ZA",
                "company": "s2s",
                "country": "sa",
                "created": "created",
                "first_name": "bob",
                "id": 1,
                "last_name": "jones",
                "modified": "modified",
                "phone": "123456",
                "province": "somewhere",
                "province_code": null,
                "type": "billing",
                "zip": "1234"
            },
            "channel_order_code": "channel_order_code",
            "notes": "notes",
            "ordered_date": "1970-01-01 00:00:00",
            "total_discount": 1.01,
            "state": "new",
            "channel_id": 2,
            "client_id": 3,
            "created": "created",
            "customer": {
                "id": 1,
                "accepts_marketing": false,
                "email": "x@y.com",
                "first_name": "bob",
                "last_name": null,
                "active": true,
                "addresses": [
                    {
                        "address1": "abc",
                        "address2": null,
                        "address_code": "address_code",
                        "city": "jhb",
                        "country_code": "ZA",
                        "company": "s2s",
                        "country": "sa",
                        "first_name": "bob",
                        "last_name": "jones",
                        "phone": "123456",
                        "province": "somewhere",
                        "province_code": null,
                        "type": "billing",
                        "zip": "1234"
                    }
                ],
                "channel_customer_code": "abc",
                "channel_id": null,
                "client_id": 21,
                "created": "2022-01-01",
                "customer_id": 123,
                "meta": [
                    {
                        "key": "group",
                        "value": "wholesale",
                        "template_name": "template_a"
                    }
                ],
                "modified": "2022-01-01",
                "user": {
                    "customer_id": 123,
                    "id": 123,
                    "segments": [
                        {
                            "type": "products",
                            "key": "collection",
                            "operator": "equal",
                            "value": "abc",
                            "owner": "source"
                        }
                    ],
                    "price_tier": "a",
                    "qty_availability": "b"
                }
            },
            "fulfillments": [
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
                    "tracking_number": "456",
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
                        "channel_id": 1,
                        "city": "city",
                        "client_id": 2,
                        "company": "company",
                        "country": "country",
                        "country_code": "country_code",
                        "first_name": "first_name",
                        "id": 3,
                        "last_name": "last_name",
                        "phone": "phone",
                        "province": "province",
                        "province_code": "province_code",
                        "type": "type",
                        "zip": "zip",
                        "created": "created",
                        "modified": "modified"
                    }
                }
            ],
            "history": [
                {
                    "instruction": "instruction",
                    "storage_code": "storage_code",
                    "created": "created",
                    "modified": "modified"
                }
            ],
            "id": 4,
            "line_item_sub_total": 5.05,
            "line_item_tax": 6.06,
            "line_items": [
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
                    "tax_lines": [
                        {
                            "rate": 15,
                            "price": 15,
                            "code": "15",
                            "title": "VAT"
                        }
                    ],
                    "tax_per_unit": 7.04,
                    "sub_total_display": "sub_total_display",
                    "total": 8.05,
                    "total_display": "total_display"
                }
            ],
            "meta": [
                {
                    "key": "src",
                    "value": "value"
                }
            ],
            "modified": "modified",
            "shipping_address": {
                "address1": "def",
                "address2": null,
                "address_code": "address_code",
                "channel_id": 56,
                "city": "cpt",
                "client_id": 21,
                "country_code": "ZA",
                "company": "s2s",
                "country": "sa",
                "created": "created",
                "first_name": "john",
                "id": 2,
                "last_name": "doe",
                "modified": "modified",
                "phone": "123456",
                "province": "somewhere",
                "province_code": null,
                "type": "billing",
                "zip": "1234"
            },
            "shipping_lines": [
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
                }
            ],
            "shipping_sub_total": 7.07,
            "shipping_tax": 8.08,
            "shipping_tax_display": "shipping_tax_display",
            "shipping_total": 9.09,
            "shipping_total_display": "shipping_total_display",
            "sources": [
                {
                    "source_id": 57,
                    "source_customer_code": "source_customer_code",
                    "source_order_code": "source_order_code"
                }
            ],
            "status": "status",
            "sub_total": 10.10,
            "sub_total_display": "sub_total_display",
            "tax": 11.11,
            "tax_display": "tax_display",
            "total": 12.12,
            "total_discount_display": "total_discount_display",
            "total_display": "total_display"
        }';
    }

    public function testSerialize(): void
    {
        $m          = DTO\SystemOrder::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\SystemOrder::createFromJSON($this->json);
        $this->assertSystemOrder($m);
    }

    private function assertSystemOrder(DTO\SystemOrder $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Order', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemOrder', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemFulfillment', $c->fulfillments[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemFulfillmentLineItem', $c->fulfillments[0]->line_items[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemOrderAddress', $c->fulfillments[0]->shipping_address);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemOrderHistory', $c->history[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderItem', $c->line_items[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemOrderItem', $c->line_items[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemFulfillmentLineItem', $c->line_items[0]->fulfillments[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderMeta', $c->meta[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderShippingLine', $c->shipping_lines[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemOrderShippingLine', $c->shipping_lines[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderSource', $c->sources[0]);
    }
}
