<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\SystemVariant;

class SystemVariantTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "source_variant_code" => "",
            "sku" => "",
            "active" => false,
            "qty" => null,
            "qty_availability" => [],
            "price" => null,
            "price_tiers" => [],
            "barcode" => null,
            "inventory_management" => null,
            "grams" => null,
            "option1" => null,
            "option2" => null,
            "option3" => null,
            "meta" => [],
            "client_id" => null,
            "hash" => "",
            "id" => null,
            "image_id" => null,
            "product_id" => null
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "source_variant_code": "",
            "sku": "",
            "active": false,
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
            "client_id": null,
            "hash": "",
            "id": null,
            "image_id": null,
            "product_id": null
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new SystemVariant($this->setUpArray());

        $this->assertSame(null, $object->client_id);
        $this->assertSame(null, $object->image_id);
        $this->assertSame("", $object->hash);
        $this->assertSame(null, $object->id);
        $this->assertSame("", $object->sku);
        $this->assertSame(false, $object->active);
        $this->assertSame([], $object->qty_availability);
        $this->assertSame(null, $object->option1);
        $this->assertSame(null, $object->option2);
        $this->assertSame(null, $object->option3);


        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemVariant", $object);

        $object_attributes = [
            "client_id",
            "image_id",
            "hash",
            "id",
            "sku",
            "active",
            "grams",
            "barcode",
            "option1",
            "option2",
            "option3",
            "qty_availability"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void
    { 
        $array = SystemVariant::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void
    { 
        $json = $this->setUpJson();
        $array = json_encode(SystemVariant::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "source_variant_code" => "",
                "sku" => "",
                "active" => false,
                "qty" => null,
                "qty_availability" => [],
                "price" => null,
                "price_tiers" => [],
                "barcode" => null,
                "inventory_management" => null,
                "grams" => null,
                "option1" => null,
                "option2" => null,
                "option3" => null,
                "meta" => [],
                "client_id" => null,
                "hash" => "",
                "id" => null,
                "image_id" => null,
                "product_id" => null
            ],
            [
                "source_variant_code" => "",
                "sku" => "",
                "active" => true,
                "qty" => null,
                "qty_availability" => [],
                "price" => null,
                "price_tiers" => [],
                "barcode" => null,
                "inventory_management" => null,
                "grams" => null,
                "option1" => "option1",
                "option2" => "option2",
                "option3" => "option3",
                "meta" => [],
                "client_id" => null,
                "hash" => "",
                "id" => null,
                "image_id" => null,
                "product_id" => null
            ]
        ];
        $json = json_encode(SystemVariant::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>