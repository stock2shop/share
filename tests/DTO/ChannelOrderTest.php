<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelOrderTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "channel_order_code": "channel_order_code",
            "notes": "notes",
            "total_discount": 5.00,
            "billing_address": {
                "address1": "address1",
                "address2": "address2",
                "city": "city",
                "company": "company",
                "country": "country",
                "country_code": "country_code",
                "first_name": "first_name",
                "last_name": "last_name",
                "phone": "phone",
                "province": "province",
                "province_code": "province_code",
                "type": "type",
                "zip": "zip"
            },
            "customer": {
                "accepts_marketing": true,
                "email": "email",
                "first_name": "first_name",
                "last_name": "last_name"
            },
            "instruction": "add_order",
            "line_items": [
                {
                    "barcode": "barcode",
                    "grams": 150,
                    "price": 19.99,
                    "qty": 100,
                    "sku": "sku",
                    "tax_lines": [
                        {
                            "price": 19.99,
                            "title": "title",
                            "rate": 1.2
                        }
                    ],
                    "title": "title",
                    "total_discount": 20.05,
                    "channel_variant_code": "channel_variant_code"
                }
            ],
            "meta": [
                {
                    "key": "key",
                    "value": "value"
                }
            ],
            "shipping_address": {
                "address1": "address1",
                "address2": "address2",
                "city": "city",
                "company": "company",
                "country": "country",
                "country_code": "country_code",
                "first_name": "first_name",
                "last_name": "last_name",
                "phone": "phone",
                "province": "province",
                "province_code": "province_code",
                "type": "type",
                "zip": "zip"
            },
            "shipping_lines": [
                {
                    "price": 19.99,
                    "tax_lines": [
                        {
                            "price": 19.99,
                            "rate": 19.99,
                            "title": "title"
                        }
                    ],
                    "title": "title"
                }
            ]
        }';
    }

    public function testSerialize(): void
    {
        $m          = DTO\ChannelOrder::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\ChannelOrder::createFromJSON($this->json);
        $this->assertChannelOrder($m);
    }

    private function assertChannelOrder(DTO\ChannelOrder $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Order', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelOrder', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelOrderCustomer', $c->customer);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelOrderAddress', $c->shipping_address);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelOrderAddress', $c->billing_address);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderShippingLine', $c->shipping_lines[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderItemTax', $c->shipping_lines[0]->tax_lines[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelOrderLineItem', $c->line_items[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderItemTax', $c->line_items[0]->tax_lines[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderMeta', $c->meta[0]);
    }
}
