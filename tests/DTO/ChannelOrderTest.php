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
            "channel_id": 20,
            "channel_order_code": "channel_order_code",
            "notes": "notes",
            "total_discount": 5.00,
            "state": "new",
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
                "channel_customer_code": "channel_customer_code",
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
                    "total_discount": 20.05
                }
            ],
            "meta": [
                {
                    "key": "key",
                    "value": "value"
                }
            ],
            "params": {
                "key-1": "value-1",
                "key-2": "value-2"
            },
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

    /** @dataProvider computeHashArrayOrderingDataProvider */
    public function testComputeHashArrayOrdering(array $channelOrders, string $expectedHash): void
    {
        foreach ($channelOrders as $channelOrder) {
            $co = new DTO\ChannelOrder($channelOrder);
            $this->assertEquals($expectedHash, $co->computeHash());
        }
    }

    /** @dataProvider computeHashNullsDataProvider */
    public function testComputeHashNulls(array $channelOrders, string $expectedHash): void
    {
        foreach ($channelOrders as $channelOrder) {
            $co = new DTO\ChannelOrder($channelOrder);
            $this->assertEquals($expectedHash, $co->computeHash());
        }
    }

    /** @dataProvider computeHashDataProvider */
    public function testComputeHash(array $channelOrder, string $expectedHash): void
    {
        $co = new DTO\ChannelOrder($channelOrder);
        $this->assertEquals($expectedHash, $co->computeHash());
    }

    private function computeHashDataProvider(): array
    {
        return [
            [
                [
                    'channel_id'         => 20,
                    "channel_order_code" => "channel_order_code",
                    "notes"              => "notes",
                    "total_discount"     => 5.00,
                    "state"              => null,
                ],
                '133cb962d81ce0a796303a0245212be9'
            ],
            [
                [
                    'channel_id'         => 20,
                    "channel_order_code" => "channel_order_code",
                    "notes"              => "notes",
                    "total_discount"     => 5.00,
                ],
                '133cb962d81ce0a796303a0245212be9'
            ],
            [
                [
                    'channel_id'         => 20,
                    "channel_order_code" => "channel_order_code",
                    "notes"              => "notes",
                    "total_discount"     => 5.00
                ],
                '133cb962d81ce0a796303a0245212be9'
            ],
            [
                [
                    "notes"              => "notes",
                    "total_discount"     => 5.00,
                    "channel_order_code" => "channel_order_code",
                    'channel_id'         => 20,
                ],
                '133cb962d81ce0a796303a0245212be9'
            ],
            [
                [
                    "channel_id"         => 20,
                    "channel_order_code" => "channel_order_code",
                    "notes"              => "notes",
                    "total_discount"     => 5.00,
                    "billing_address"    => [
                        "address1"      => "address1",
                        "address2"      => "address2",
                        "city"          => "city",
                        "company"       => "company",
                        "country"       => "country",
                        "country_code"  => "country_code",
                        "first_name"    => "first_name",
                        "last_name"     => "last_name",
                        "phone"         => "phone",
                        "province"      => "province",
                        "province_code" => "province_code",
                        "type"          => "type",
                        "zip"           => "zip"
                    ],
                    "customer"           => [
                        "accepts_marketing"     => true,
                        "channel_customer_code" => "channel_customer_code",
                        "email"                 => "email",
                        "first_name"            => "first_name",
                        "last_name"             => "last_name"
                    ],
                    "instruction"        => "add_order",
                    "line_items"         => [
                        [
                            "barcode"              => "barcode",
                            "grams"                => 150,
                            "price"                => 19.99,
                            "qty"                  => 100,
                            "sku"                  => "sku",
                            "tax_lines"            => [
                                [
                                    "price" => 19.99,
                                    "title" => "title",
                                    "rate"  => 1.2
                                ]
                            ],
                            "title"                => "title",
                            "total_discount"       => 20.05,
                            "channel_variant_code" => "channel_variant_code"
                        ],
                        [
                            "barcode"              => "barcode-1",
                            "grams"                => 151,
                            "price"                => 20.00,
                            "qty"                  => 200,
                            "sku"                  => "sku-1",
                            "tax_lines"            => [
                                [
                                    "price" => 29.99,
                                    "title" => "title-1",
                                    "rate"  => 2.0
                                ]
                            ],
                            "title"                => "title-1",
                            "total_discount"       => 30.00,
                            "channel_variant_code" => "channel_variant_code-1"
                        ]
                    ],
                    "meta"               => [
                        [
                            "key"   => "key",
                            "value" => "value"
                        ],
                        [
                            "key"   => "key-1",
                            "value" => "value-1"
                        ]
                    ],
                    "params"             => [
                        "key-1" => "value-1",
                        "key-2" => "value-2"
                    ],
                    "shipping_address"   => [
                        "address1"      => "address1",
                        "address2"      => "address2",
                        "city"          => "city",
                        "company"       => "company",
                        "country"       => "country",
                        "country_code"  => "country_code",
                        "first_name"    => "first_name",
                        "last_name"     => "last_name",
                        "phone"         => "phone",
                        "province"      => "province",
                        "province_code" => "province_code",
                        "type"          => "type",
                        "zip"           => "zip"
                    ],
                    "shipping_lines"     => [
                        [
                            "price"     => 19.99,
                            "tax_lines" => [
                                [
                                    "price" => 19.99,
                                    "rate"  => 19.99,
                                    "title" => "title"
                                ]
                            ],
                            "title"     => "title"
                        ],
                        [
                            "price"     => 20.00,
                            "tax_lines" => [
                                [
                                    "price" => 21.00,
                                    "rate"  => 22.00,
                                    "title" => "title-1"
                                ]
                            ],
                            "title"     => "title-1"
                        ]
                    ]
                ],
                'bbdfbd0a6e8aa8181232bbc773819cc1'
            ],
        ];
    }

    private function computeHashNullsDataProvider(): array
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
                        "billing_address"    => [
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
                        "customer"           => [
                            "accepts_marketing" => null,
                            "email"             => null,
                            "first_name"        => null,
                            "last_name"         => null,
                        ],
                        "instruction"        => null,
                        "line_items"         => [],
                        "meta"               => [],
                        "params"             => [],
                        "shipping_address"   => [
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
                    ],
                ],
                'bae19b9cb25ee6a7186bbed0072f1015',
            ]
        ];
    }

    private function computeHashArrayOrderingDataProvider(): array
    {
        return [
            [
                [
                    [
                        'line_items'     => [
                            [
                                "price" => 19.99,
                                "qty"   => 100,
                                "sku"   => "sku-2"
                            ],
                            [
                                "price"     => 19.99,
                                "qty"       => 100,
                                "sku"       => "sku-1",
                                "tax_lines" => [
                                    [
                                        "price" => 10.01,
                                        "title" => "title-1",
                                        "rate"  => 10
                                    ],
                                    [
                                        "price" => 29.99,
                                        "title" => "title-2",
                                        "rate"  => 15
                                    ]
                                ]
                            ]
                        ],
                        'meta'           => [
                            [
                                'key'   => 'a',
                                'value' => '1'
                            ],
                            [
                                'key'   => 'b',
                                'value' => '2'
                            ]
                        ],
                        'params'         => [
                            'key-1' => 'value-1',
                            'key-2' => 'value-2'
                        ],
                        'shipping_lines' => [
                            [
                                'price' => 100,
                                'title' => '1'
                            ],
                            [
                                'price' => 200,
                                'title' => '2'
                            ]
                        ]
                    ],
                    [
                        'line_items'     => [
                            [
                                "price"     => 19.99,
                                "qty"       => 100,
                                "sku"       => "sku-1",
                                "tax_lines" => [
                                    [
                                        "price" => 29.99,
                                        "title" => "title-2",
                                        "rate"  => 15
                                    ],
                                    [
                                        "price" => 10.01,
                                        "title" => "title-1",
                                        "rate"  => 10
                                    ]
                                ]
                            ],
                            [
                                "price" => 19.99,
                                "qty"   => 100,
                                "sku"   => "sku-2"
                            ],
                        ],
                        'meta'           => [
                            [
                                'key'   => 'b',
                                'value' => '2'
                            ],
                            [
                                'key'   => 'a',
                                'value' => '1'
                            ]
                        ],
                        'params'         => [
                            'key-2' => 'value-2',
                            'key-1' => 'value-1'
                        ],
                        'shipping_lines' => [
                            [
                                'price' => 200,
                                'title' => '2'
                            ],
                            [
                                'price' => 100,
                                'title' => '1'
                            ]
                        ]
                    ]
                ],
                'hash' => '22f98cef9c89fb048e296d7e9f776064',
            ]
        ];
    }
}
