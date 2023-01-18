<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ChannelOrder;

class ChannelOrdertest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "line_items" => 
            [
                ["barcode" => "0", "grams" => "0", "sku" => ""],
                ["barcode" => "56", "grams" => "0", "sku" => ""],
                ["barcode" => "32", "grams" => "0", "sku" => ""]
            ],
            "meta" => [],
            "params" => ["default_customer_code" => "Easy"],
            "shipping_lines" => 
            [
                ["price" => "", "title" => ""]
            ],
            "billing_address" => ["address1" => "", "address2" => ""],
            "customer" => ["first_name" => "Keenan", "last_name" => "Faure"],
            "instruction" => "add_order",
            "shipping_address" => ["address1" => "", "address2" => ""]
        ];
        return $array;
    }
    private function setUpJson(): string
    { 
        $json = '
        {
            "channel_id": null,
            "channel_order_code": null,
            "notes": null,
            "total_discount": null,
            "state": null,
            "billing_address": {
                "address1": "",
                "address2": "",
                "city": null,
                "company": null,
                "country": null,
                "country_code": null,
                "first_name": null,
                "last_name": null,
                "phone": null,
                "province": null,
                "province_code": null,
                "type": null,
                "zip": null
            },
            "customer": {
                "accepts_marketing": null,
                "email": null,
                "first_name": "Keenan",
                "last_name": "Faure",
                "channel_customer_code": null
            },
            "instruction": "add_order",
            "line_items": [{
                "barcode": "0",
                "grams": 0,
                "price": null,
                "qty": null,
                "sku": "",
                "title": null,
                "total_discount": null,
                "tax_lines": []
            }, {
                "barcode": "56",
                "grams": 0,
                "price": null,
                "qty": null,
                "sku": "",
                "title": null,
                "total_discount": null,
                "tax_lines": []
            }, {
                "barcode": "32",
                "grams": 0,
                "price": null,
                "qty": null,
                "sku": "",
                "title": null,
                "total_discount": null,
                "tax_lines": []
            }],
            "meta": [],
            "params": {
                "default_customer_code": "Easy"
            },
            "shipping_address": {
                "address1": "",
                "address2": "",
                "city": null,
                "company": null,
                "country": null,
                "country_code": null,
                "first_name": null,
                "last_name": null,
                "phone": null,
                "province": null,
                "province_code": null,
                "type": null,
                "zip": null
            },
            "shipping_lines": [{
                "price": null,
                "title": "",
                "tax_lines": []
            }]
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    {
        $order = new ChannelOrder($this->setUpArray());

        $this->assertSame(null, $order->channel_id);
        $this->assertSame("", $order->billing_address->address1);
        $this->assertSame("", $order->shipping_address->address2);
        $this->assertSame("add_order", $order->instruction);
        $this->assertSame("Keenan", $order->customer->first_name);
        $this->assertSame("Faure", $order->customer->last_name);
        $this->assertSame("Easy", $order->params['default_customer_code']);
        for($i = 0; $i < sizeof($order->shipping_lines); ++$i)
        {
            $this->assertSame("", $order->shipping_lines[$i]->title);
        }
        $this->assertSame(null, $order->channel_id);

        for($i = 0; $i < sizeof($order->line_items); ++$i)
        {
            $this->assertSame("", $order->line_items[$i]->sku);
        }

        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelOrder", $order);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelOrderLineItem", $order->line_items[0]);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelOrderAddress", $order->billing_address);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelOrderCustomer", $order->customer);

        $object_attributes = [
            "channel_id", 
            "channel_order_code",
            "notes",
            "total_discount",
            "state",
            "billing_address",
            "customer",
            "instruction",
            "line_items",
            "meta",
            "params",
            "shipping_address",
            "shipping_lines"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $order);
        }
    }

    // public function testHash(): void { }
    public function testSerialize(): void 
    { 
        $array = ChannelOrder::createArray($this->setUpArray())[0];
        
        $result = json_encode($array->jsonSerialize());

        $this->assertJsonStringEqualsJsonString(json_encode($array), $result);
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(ChannelOrder::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    {
        $array = 
        [[
                "channel_id" => "21", 
                "channel_order_code" => "1972",
                "notes" => "",
                "total_discount" => "",
                "state" => "",
                "billing_address" => ["address1" => "Samantha Street", "address2" => ""],
                "customer" => "",
                "instruction" => "",
                "line_items" => 
                    [["barcode" => "0", "grams" => "0", "sku" => ""],
                    ["barcode" => "56", "grams" => "0", "sku" => ""],
                    ["barcode" => "32", "grams" => "0", "sku" => ""]],
                "meta" => [],
                "params" => [],
                "shipping_address" => ["address1" => "", "address2" => "Montrose Park"],
                "shipping_lines" => []
            ],
            [
                "channel_id" => "21", 
                "channel_order_code" => "1973",
                "notes" => "",
                "total_discount" => "",
                "state" => "",
                "billing_address" => "",
                "customer" => "",
                "instruction" => "",
                "line_items" => 
                    [["barcode" => "0", "grams" => "0", "sku" => "GenImp-V-AA"],
                    ["barcode" => "56", "grams" => "0", "sku" => "GenImp-D-PC"]],
                "meta" => [],
                "params" => [],
                "shipping_address" => ["address1" => "14 Tracy Close", "address2" => ""],
                "shipping_lines" => []
        ]];

        $json = '
        [{
            "channel_id": "21",
            "channel_order_code": "1972",
            "notes": "",
            "total_discount": "",
            "state": "",
            "billing_address": {
                "address1": "Samantha Street",
                "address2": ""
            },
            "customer": "",
            "instruction": "",
            "line_items": [{
                "barcode": "0",
                "grams": "0",
                "sku": ""
            }, {
                "barcode": "56",
                "grams": "0",
                "sku": ""
            }, {
                "barcode": "32",
                "grams": "0",
                "sku": ""
            }],
            "meta": [],
            "params": [],
            "shipping_address": {
                "address1": "",
                "address2": "Montrose Park"
            },
            "shipping_lines": []
        }, {
            "channel_id": "21",
            "channel_order_code": "1973",
            "notes": "",
            "total_discount": "",
            "state": "",
            "billing_address": "",
            "customer": "",
            "instruction": "",
            "line_items": [{
                "barcode": "0",
                "grams": "0",
                "sku": "GenImp-V-AA"
            }, {
                "barcode": "56",
                "grams": "0",
                "sku": "GenImp-D-PC"
            }],
            "meta": [],
            "params": [],
            "shipping_address": {
                "address1": "14 Tracy Close",
                "address2": ""
            },
            "shipping_lines": []
        }]';
        
        $this->assertJsonStringEqualsJsonString($json, json_encode($array));
    }
}

?>