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
            "ordered_date": "1970-01-01 00:00:00",
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
                            "rate": 1.2,
                            "code": "abc"
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
                            "code": "ABC",
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
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelOrderItem', $c->line_items[0]);
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
                    "ordered_date"       => "1970-01-01 00:00:00",
                    "total_discount"     => 5.00,
                    "state"              => null,
                ],
                '97962fc7dc4c014891c9da22b8fe5f2c'
            ],
            [
                [
                    'channel_id'         => 20,
                    "channel_order_code" => "channel_order_code",
                    "notes"              => "notes",
                    "ordered_date"       => "1970-01-01 00:00:00",
                    "total_discount"     => 5.00,
                ],
                '97962fc7dc4c014891c9da22b8fe5f2c'
            ],
            [
                [
                    'channel_id'         => 20,
                    "channel_order_code" => "channel_order_code",
                    "notes"              => "notes",
                    "ordered_date"       => "1970-01-01 00:00:00",
                    "total_discount"     => 5.00
                ],
                '97962fc7dc4c014891c9da22b8fe5f2c'
            ],
            [
                [
                    "notes"              => "notes",
                    "ordered_date"       => "1970-01-01 00:00:00",
                    "total_discount"     => 5.00,
                    "channel_order_code" => "channel_order_code",
                    'channel_id'         => 20,
                ],
                '97962fc7dc4c014891c9da22b8fe5f2c'
            ],
            [
                [
                    "channel_id"         => 20,
                    "channel_order_code" => "channel_order_code",
                    "notes"              => "notes",
                    "ordered_date"       => "1970-01-01 00:00:00",
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
                '07b49efe0d7d73a26ba0d36ef7cf6e02'
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
                        "ordered_date"       => null,
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
                '9e33155b10c62e10122b770030ddd878',
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
                                'price'     => 100,
                                'title'     => '1',
                                'tax_lines' => [
                                    [
                                        'title' => 'VAT',
                                        'price' => 20,
                                        'rate'  => 15,
                                        'code'  => 'abc',
                                    ]
                                ]
                            ],
                            [
                                'price'     => 200,
                                'title'     => '2',
                                'tax_lines' => [
                                    [
                                        'title' => 'VAT',
                                        'price' => 201,
                                        'rate'  => 10,
                                        'code'  => 'xyz',
                                    ]
                                ]
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
                                'price'     => 200,
                                'title'     => '2',
                                'tax_lines' => [
                                    [
                                        'title' => 'VAT',
                                        'price' => 201,
                                        'rate'  => 10,
                                        'code'  => 'xyz',
                                    ]
                                ]
                            ],
                            [
                                'price'     => 100,
                                'title'     => '1',
                                'tax_lines' => [
                                    [
                                        'title' => 'VAT',
                                        'price' => 20,
                                        'rate'  => 15,
                                        'code'  => 'abc',
                                    ]
                                ]
                            ]
                        ]
                    ]
                ],
                'hash' => '52c1d97163f3d8dd1d4a059080116534',
            ]
        ];
    }
}
