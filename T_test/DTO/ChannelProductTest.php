<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;

use PHPUnit\Framework\Constraint\IsTrue;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ChannelProduct;

class ChannelProductTest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "active" => "true",
            "title" => "Title",
            "body_html" => "",
            "collection" => "",
            "product_type" => "",
            "tags" => "",
            "vendor" => "Mihoyo",
            "options" => [["name" => "Size", "position" => "1"]],
            "meta" => [["key" => "", "value" => "", "template_name" => ""]],
            "channel_id" => "",
            "synced" => "false",
            "images" => [["active" => "false"]],
            "variants" => [["channel_id" => ""]]
        ];
        return $array;
    }

    private function setUpJson(): string
    { 
        $json = '{
            "active": true,
            "title": "Title",
            "body_html": "",
            "collection": "",
            "product_type": "",
            "tags": "",
            "vendor": "Mihoyo",
            "options": [{
                "name": null,
                "position": null
            }],
            "meta": [{
                "key": null,
                "value": null,
                "template_name": null
            }],
            "channel_id": null,
            "channel_product_code": null,
            "client_id": null,
            "created": null,
            "delete": null,
            "hash": null,
            "id": null,
            "images": [],
            "modified": null,
            "source_id": null,
            "source_product_code": null,
            "success": null,
            "synced": "false",
            "variants": [{
                "source_variant_code": null,
                "sku": null,
                "active": null,
                "qty": null,
                "qty_availability": [],
                "price": null,
                "price_tiers": [],
                "barcode": null,
                "inventory_management": null,
                "grams": null,
                "option1": null,
                "option2": null,
                "option3": null,
                "meta": [],
                "channel_id": null,
                "channel_variant_code": null,
                "client_id": null,
                "delete": null,
                "hash": null,
                "id": null,
                "image_id": null,
                "product_id": null,
                "success": null
            }]
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new ChannelProduct($this->setUpArray());
        $this->assertSame(true, $object->active);
        $this->assertSame("", $object->body_html);
        $this->assertSame(1, $object->options[0]->position);
        $this->assertSame("", $object->meta[0]->key);
        $this->assertSame(null, $object->channel_id);
        $this->assertSame(null, $object->channel_product_code);
        $this->assertSame(false, $object->images[0]->active);
        $this->assertSame(null, $object->variants[0]->sku);
        $this->assertSame(null, $object->variants[0]->price);
        $this->assertSame([], $object->variants[0]->price_tiers);
        $this->assertSame([], $object->variants[0]->meta);
        $this->assertSame(null, $object->variants[0]->id);


        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelProduct", $object);

        $object_attributes = [
            "channel_id",
            "channel_product_code",
            "client_id",
            "created",
            "delete",
            "hash",
            "id",
            "images",
            "modified",
            "source_id",
            "source_product_code",
            "success",
            "synced",
            "variants",
            "active",
            "vendor"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testHash(): void 
    { 

    }

    // public function testSerialize(): void { }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(ChannelProduct::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "active" => true,
                "title" => "Title",
                "body_html" => "",
                "collection" => "",
                "product_type" => "",
                "tags" => "",
                "vendor" => "Mihoyo",
                "options" => [["name" => "Size", "position" => 1]],
                "meta" => [["key" => null, "value" => null, "template_name" => null]],
                "channel_id" => null,
                "channel_product_code" => null,
                "client_id" => null,
                "created" => "",
                "delete" => false,
                "hash" => "",
                "id" => null,
                "modified" => "",
                "source_id" => null,
                "source_product_code" => "",
                "success" => false,
                "synced" => "false",
                "images" => 
                [[
                    "active" => false,
                    "channel_id" => null,
                    "channel_image_code" => "",
                    "delete" => false,
                    "id" => null,
                    "src" => null,
                    "success" => false
                ]],
                "variants" => 
                [[
                    "source_variant_code" => null,
                    "sku" => "GenImp-V-AA",
                    "active" => null,
                    "qty" => 0,
                    "qty_availability" => [],
                    "price" => null,
                    "price_tiers"=> [],
                    "barcode" => "12345",
                    "inventory_management" => null,
                    "grams" => null,
                    "option1" => "",
                    "option2" => null,
                    "option3" => null,
                    "meta" => [],
                    "channel_id" => null,
                    "channel_variant_code" => null,
                    "client_id" => null,
                    "delete" => null,
                    "hash" => null,
                    "id" => null,
                    "image_id" => null,
                    "product_id" => null,
                    "success" => null
                ]]
            ],
            [
                "active" => false,
                "title" => "Title Test",
                "body_html" => "",
                "collection" => "",
                "product_type" => "",
                "tags" => "",
                "vendor" => "Mihoyo",
                "options" => [["name" => "Color", "position" => 1]],
                "meta" => [["key" => null, "value" => null, "template_name" => null]],
                "channel_id" => null,
                "channel_product_code" => null,
                "client_id" => null,
                "created" => "",
                "delete" => true,
                "hash" => "",
                "id" => null,
                "modified" => "",
                "source_id" => null,
                "source_product_code" => "",
                "success" => true,
                "synced" => "true",
                "images" => 
                [[
                    "active" => true,
                    "channel_id" => null,
                    "channel_image_code" => "",
                    "delete" => false,
                    "id" => null,
                    "src" => null,
                    "success" => true
                ]],
                "variants" => 
                [[
                    "source_variant_code" => null,
                    "sku" => "GenImp-M-HC",
                    "active" => null,
                    "qty" => 0,
                    "qty_availability" => [],
                    "price" => null,
                    "price_tiers"=> [],
                    "barcode" => "54321",
                    "inventory_management" => null,
                    "grams" => null,
                    "option1" => "",
                    "option2" => null,
                    "option3" => null,
                    "meta" => [],
                    "channel_id" => null,
                    "channel_variant_code" => null,
                    "client_id" => null,
                    "delete" => null,
                    "hash" => null,
                    "id" => null,
                    "image_id" => null,
                    "product_id" => null,
                    "success" => null
                ]]
            ]
        ];
        $json = json_encode(ChannelProduct::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    /** @dataProvider computeProductHash_valid */
    public function testComputeHash(array $channelOrder, string $expectedValue): void
    {
        $ch_order = new ChannelProduct($channelOrder);
        $this->assertEquals($expectedValue, $ch_order->computeHash());
    }

    /** @dataProvider computeProductHash_null */
    public function testComputeHash_null(array $channelOrders, string $expectedValue): void
    {
        foreach($channelOrders as $channelOrder)
        {
            $ch_order = new ChannelProduct($channelOrder);
            $this->assertEquals($expectedValue, $ch_order->computeHash());
        }
    }

    private function computeProductHash_valid(): array
    {
        return [
            /** First Case */
            [
                [
                    "active" => true,
                    "title" => "Title",
                    "body_html" => "",
                    "collection" => null,
                    "product_type" => ""
                ],
                "962f0d95f630abb1b13e05fa048d8ffa"
            ],
            /** Second Case */
            /** Left a property out */
            [
                [
                    "active" => true,
                    "title" => "Title",
                    "body_html" => "",
                    "product_type" => ""
                ],
                "962f0d95f630abb1b13e05fa048d8ffa"
            ],
            /** Third Case */
            /** Swaps around properties */
            [
                [
                    "product_type" => "",
                    "title" => "Title",
                    "active" => true,
                    "collection" => "",
                    "body_html" => ""
                ],
                "ad758e0236002b578235929e11e5d8f2"
            ],
            /** Fourth Test */
            /** All Object properties */
            [
                [
                    "active" => true,
                    "title" => "Title",
                    "body_html" => "",
                    "collection" => "",
                    "product_type" => "",
                    "tags" => "",
                    "vendor" => "Mihoyo",
                    "options" => [["name" => "Size", "position" => 1]],
                    "meta" => [["key" => null, "value" => null, "template_name" => null]],
                    "channel_id" => null,
                    "channel_product_code" => null,
                    "client_id" => null,
                    "created" => "",
                    "delete" => false,
                    "hash" => "",
                    "id" => null,
                    "modified" => "",
                    "source_id" => null,
                    "source_product_code" => "",
                    "success" => false,
                    "synced" => "false",
                    "images" => 
                    [[
                        "active" => false,
                        "channel_id" => null,
                        "channel_image_code" => "",
                        "delete" => false,
                        "id" => null,
                        "src" => null,
                        "success" => false
                    ]],
                    "variants" => 
                    [[
                        "source_variant_code" => null,
                        "sku" => "GenImp-V-AA",
                        "active" => null,
                        "qty" => 0,
                        "qty_availability" => [],
                        "price" => null,
                        "price_tiers"=> [],
                        "barcode" => "12345",
                        "inventory_management" => null,
                        "grams" => null,
                        "option1" => "",
                        "option2" => null,
                        "option3" => null,
                        "meta" => [],
                        "channel_id" => null,
                        "channel_variant_code" => null,
                        "client_id" => null,
                        "delete" => null,
                        "hash" => null,
                        "id" => null,
                        "image_id" => null,
                        "product_id" => null,
                        "success" => null
                    ]]
                ],
                "72ad432e04bd38f483b817d6a63204df"
            ]
        ];
    }

    private function computeProductHash_null(): array
    {
        return [
            [
                [
                    [],
                    [
                        "active" => null,
                        "title" => null,
                        "body_html" => null,
                        "collection" => null,
                        "product_type" => null,
                        "tags" => null,
                        "vendor" => null,
                        "options" => [["name" => null, "position" => null]],
                        "meta" => [["key" => null, "value" => null, "template_name" => null]],
                        "channel_id" => null,
                        "channel_product_code" => null,
                        "client_id" => null,
                        "created" => null,
                        "delete" => false,
                        "hash" => "",
                        "id" => null,
                        "modified" => null,
                        "source_id" => null,
                        "source_product_code" => null,
                        "success" => false,
                        "synced" => "false",
                        "images" => 
                        [[
                            "active" => false,
                            "channel_id" => null,
                            "channel_image_code" => null,
                            "delete" => false,
                            "id" => null,
                            "src" => null,
                            "success" => false
                        ]],
                        "variants" => 
                        [[
                            "source_variant_code" => null,
                            "sku" => null,
                            "active" => null,
                            "qty" => 0,
                            "qty_availability" => [],
                            "price" => null,
                            "price_tiers"=> [],
                            "barcode" => null,
                            "inventory_management" => null,
                            "grams" => null,
                            "option1" => null,
                            "option2" => null,
                            "option3" => null,
                            "meta" => [],
                            "channel_id" => null,
                            "channel_variant_code" => null,
                            "client_id" => null,
                            "delete" => null,
                            "hash" => null,
                            "id" => null,
                            "image_id" => null,
                            "product_id" => null,
                            "success" => null
                        ]]
                    ]
                ],
                "e184d328067fa586c7c12189b3623e7e"
            ]
        ];
    }
}

?>