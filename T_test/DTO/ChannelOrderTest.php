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

    /** @dataProvider computeHash */
    public function testComputeHash(array $channelOrder, string $expectedValue): void
    {
        $ch_order = new ChannelOrder($channelOrder);
        $this->assertEquals($expectedValue, $ch_order->computeHash());
    }

    /** @dataProvider computeHash_null */
    public function testComputeHash_null(array $channelOrders, string $expectedValue): void
    {
        foreach($channelOrders as $channelOrder)
        {
            $ch_order = new ChannelOrder($channelOrder);
            $this->assertEquals($expectedValue, $ch_order->computeHash());
        }
    }

    

    private function computeHash(): array
    {
        return [
            /** First case */
            [
                [
                    "channel_id" => 65, 
                    "channel_order_code" => "187",
                    "notes" => null,
                    "total_discount" => 0,
                    "state" => "",
                    "billing_address" => ["address1" => "Samantha Street", "address2" => ""]
                ],
                "982ac1088089f16a25b76df5da8ca870",
            ],
            /** Second Case */
            /** Left a property out */
            [
                [
                    "channel_id" => 65, 
                    "channel_order_code" => "187",
                    "total_discount" => 0,
                    "state" => "",
                    "billing_address" => ["address1" => "Samantha Street", "address2" => ""],
                ],
                "982ac1088089f16a25b76df5da8ca870"
            ],
            /** Third Case */
            /** Swaps around properties */
            [
                [
                    "billing_address" => ["address1" => "Samantha Street", "address2" => ""],
                    "channel_order_code" => "187",
                    "channel_id" => 65,
                    "state" => "",
                    "total_discount" => 0,
                ],
                "982ac1088089f16a25b76df5da8ca870"
            ],
            /** Fourth Test */
            /** All Object properties */
            [
                [
                    "channel_id" => 21, 
                    "channel_order_code" => "1972",
                    "notes" => "noted",
                    "total_discount" => 0,
                    "state" => "state",
                    "billing_address" => 
                    [
                        "address1" => "",
                        "address2" => "",
                        "city" => "",
                        "company" => "",
                        "country" => "",
                        "country_code" => "",
                        "first_name" => "",
                        "last_name" => "",
                        "phone" => "",
                        "province" => "",
                        "province_code" => "",
                        "type" => "",
                        "zip" => "",
                    ],
                    "customer" => 
                    [
                        "accepts_marketing" => "",
                        "email" => "",
                        "first_name" => "",
                        "last_name" => "",
                        "channel_customer_code" => ""
                    ],
                    "instruction" => "instruction",
                    "line_items" => 
                    [
                        [
                            "barcode" => "0",
                            "grams" => 0,
                            "price" => 0,
                            "qty" => 0,
                            "sku" => "",
                            "title" => "",
                            "total_discount" => 0,
                            "tax_lines" => []
                        ],
                        [
                            "barcode" => "0",
                            "grams" => 0,
                            "price" => 0,
                            "qty" => 0,
                            "sku" => "",
                            "title" => "",
                            "total_discount" => 0,
                            "tax_lines" => []
                        ]
                    ],
                    "meta" => 
                    [
                        [
                            "key" => "key_1",
                            "value" => "value_1"
                        ],
                        [
                            "key" => "key_2",
                            "value" => "value_2"
                        ]
                    ],
                    "params" => 
                    [
                        "param_1" => "param_value_1",
                        "param_2" => "param_value_2",
                        "param_3" => "param_value_3"
                    ],
                    "shipping_address" => 
                    [
                        "address1" => "",
                        "address2" => "Montrose Park"
                    ],
                    "shipping_lines" => 
                    [
                        [
                            "address1" => "address_1",
                            "address2" => "address_2",
                            "city" => "city",
                            "company" => "company",
                            "country" => "country",
                            "country_code" => "country_code",
                            "first_name" => "first_name",
                            "last_name" => "last_name",
                            "phone" => "phone",
                            "province" => "province",
                            "province_code" => "province_code",
                            "type" => "type",
                            "zip" => "zip"
                        ],
                        [
                            "address1" => "address_1",
                            "address2" => "address_2",
                            "city" => "city",
                            "company" => "company",
                            "country" => "country",
                            "country_code" => "country_code",
                            "first_name" => "first_name",
                            "last_name" => "last_name",
                            "phone" => "phone",
                            "province" => "province",
                            "province_code" => "province_code",
                            "type" => "type",
                            "zip" => "zip"
                        ]
                    ]
                ],
                "c768368f25e4f6487cee80decca34b88"
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
                        "channel_id"         => null,
                        "channel_order_code" => null,
                        "notes"              => null,
                        "total_discount"     => null,
                        "billing_address"    => 
                        [
                            "address1"      => null,
                            "address2"      => null,
                            "city"          => null,
                            "company"       => null,
                            "country"       => null,
                            "country_code"  => null,
                            "first_name"    => null,
                            "last_name"     => null,
                            "phone"         => null,
                            "province"      => null,
                            "province_code" => null,
                            "type"          => null,
                            "zip"           => null,
                        ],
                        "customer"           => 
                        [
                            "accepts_marketing" => null,
                            "email"             => null,
                            "first_name"        => null,
                            "last_name"         => null,
                        ],
                        "instruction"        => null,
                        "line_items"         => [],
                        "meta"               => [],
                        "params"             => [],
                        "shipping_address"   => 
                        [
                            "address1"      => null,
                            "address2"      => null,
                            "city"          => null,
                            "company"       => null,
                            "country"       => null,
                            "country_code"  => null,
                            "first_name"    => null,
                            "last_name"     => null,
                            "phone"         => null,
                            "province"      => null,
                            "province_code" => null,
                            "type"          => null,
                            "zip"           => null,
                        ],
                        "shipping_lines"     => []
                    ]
                ],
                "bae19b9cb25ee6a7186bbed0072f1015"
            ]
        ];
    }
}

?>