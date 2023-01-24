<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ChannelVariant;

class ChannelVariantTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "source_variant_code" => null,
            "sku" => "GenImp-V-AA",
            "active" => "false",
            "qty" => 0,
            "qty_availability" => [[
                "description" => "",
                "qty" => "0"
            ]],
            "price" => null,
            "price_tiers"=> [[
                "tier" => "",
                "price" => "0"
            ]],
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
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "source_variant_code": null,
            "sku": "GenImp-V-AA",
            "active": false,
            "qty": 0,
            "qty_availability": [{
                "description": "",
                "qty": 0
            }],
            "price": null,
            "price_tiers": [{
                "tier": "",
                "price": 0
            }],
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
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new ChannelVariant($this->setUpArray());

        $this->assertSame(null, $object->channel_id);
        $this->assertSame(null, $object->channel_variant_code);
        $this->assertSame(null, $object->client_id);
        $this->assertSame(false, $object->active);
        $this->assertSame([], $object->meta);
        $this->assertSame(null, $object->delete);
        $this->assertSame("", $object->option1);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelVariant", $object);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\PriceTier", $object->price_tiers[0]);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\QtyAvailability", $object->qty_availability[0]);

        $object_attributes = [
            "source_variant_code",
            "sku",
            "active",
            "qty",
            "qty_availability",
            "price",
            "price_tiers",
            "barcode",
            "inventory_management",
            "grams",
            "option1",
            "option2",
            "option3",
            "meta",
            "channel_id",
            "channel_variant_code",
            "client_id",
            "delete",
            "hash",
            "id",
            "image_id",
            "product_id",
            "success"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    // public function testSerialize(): void { }
    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(ChannelVariant::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "source_variant_code" => null,
                "sku" => "",
                "active" => true,
                "qty" => 0,
                "qty_availability" => [[
                    "description" => "",
                    "qty" => 0
                ]],
                "price" => null,
                "price_tiers"=> [[
                    "tier" => "",
                    "price" => 0
                ]],
                "barcode" => "",
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
            ],
            [
                "source_variant_code" => null,
                "sku" => "",
                "active" => false,
                "qty" => 0,
                "qty_availability" => [[
                    "description" => "",
                    "qty" => 0
                ]],
                "price" => null,
                "price_tiers"=> [[
                    "tier" => "",
                    "price" => 0
                ]],
                "barcode" => "",
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
            ]
        ];
        $json = json_encode(ChannelVariant::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>