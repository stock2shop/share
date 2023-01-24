<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ChannelProducts;

class ChannelProductsTest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "channel_products" =>
            [[
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
            ]]
        ];
        return $array;
    }
    private function setUpJson(): string
    { 
        $json = '{
            "channel_products": [{
                "active": true,
                "title": "Title",
                "body_html": "",
                "collection": "",
                "product_type": "",
                "tags": "",
                "vendor": "Mihoyo",
                "options": [{
                    "name": "Size",
                    "position": 1
                }],
                "meta": [{
                    "key": null,
                    "value": null,
                    "template_name": null
                }],
                "channel_id": null,
                "channel_product_code": null,
                "client_id": null,
                "created": "",
                "delete": false,
                "hash": "",
                "id": null,
                "images": [{
                    "src": null,
                    "active": false,
                    "channel_id": null,
                    "channel_image_code": "",
                    "delete": false,
                    "id": null,
                    "success": false
                }],
                "modified": "",
                "source_id": null,
                "source_product_code": "",
                "success": false,
                "synced": "false",
                "variants": [{
                    "source_variant_code": null,
                    "sku": "GenImp-V-AA",
                    "active": null,
                    "qty": 0,
                    "qty_availability": [],
                    "price": null,
                    "price_tiers": [],
                    "barcode": "12345",
                    "inventory_management": null,
                    "grams": null,
                    "option1": "",
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
            }]
        }';

        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $array = $this->setUpArray();
        $object = new ChannelProducts($array);
        foreach($object as $channelProducts)
        {
            $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelProducts", $object);
            foreach($channelProducts as $channelProduct)
            {
                $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelImage", $channelProduct->images[0]);
                $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelVariant", $channelProduct->variants[0]);
            }
        }
    }
    
    //public function testSerialize(): void { }
    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(ChannelProducts::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
        [
            "channel_products" =>
            [[
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
                "title" => "Product Title",
                "body_html" => "",
                "collection" => "",
                "product_type" => "",
                "tags" => "",
                "vendor" => "Mihoyo",
                "options" => [["name" => "Size", "position" => 2]],
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
                "success" => false,
                "synced" => "false",
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
                    "sku" => "Genshin",
                    "active" => null,
                    "qty" => 0,
                    "qty_availability" => [],
                    "price" => null,
                    "price_tiers"=> [],
                    "barcode" => "246810",
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
            ]]
        ]];

        $json = json_encode(ChannelProducts::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>