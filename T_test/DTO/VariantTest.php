<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\Variant;

class VariantTest extends TestCase
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
            "meta" => []
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
            "meta": []
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new Variant($this->setUpArray());

        $this->assertSame("", $object->source_variant_code);
        $this->assertSame("", $object->sku);
        $this->assertSame(false, $object->active);
        $this->assertSame(null, $object->qty);
        $this->assertSame([], $object->qty_availability);
        $this->assertSame(null, $object->price);
        $this->assertSame([], $object->price_tiers);
        $this->assertSame(null, $object->barcode);
        $this->assertSame(null, $object->option1);
        $this->assertSame(null, $object->grams);


        $this->assertInstanceOf("Stock2Shop\Share\DTO\Variant", $object);

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
            "option3"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void
    { 
        $array = Variant::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void
    { 
        $json = $this->setUpJson();
        $array = json_encode(Variant::createFromJSON($json));

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
                "meta" => []
            ],
            [
                "source_variant_code" => "source_variant_code",
                "sku" => "sku",
                "active" => true,
                "qty" => null,
                "qty_availability" => [],
                "price" => 0,
                "price_tiers" => [],
                "barcode" => null,
                "inventory_management" => null,
                "grams" => null,
                "option1" => "",
                "option2" => "",
                "option3" => "",
                "meta" => []
            ]
        ];
        $json = json_encode(Variant::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    /** @dataProvider computeHash */
    public function testComputeHash(array $variant, string $expectedValue): void 
    {
        $var = new Variant($variant);
        $this->assertEquals($expectedValue, $var->computeHash());
    }

    /** @dataProvider computeHash_null */
    public function testComputeHash_null(array $variants, string $expectedValue): void 
    {
        foreach($variants as $variant)
        {
            $var = new Variant($variant);
            $this->assertEquals($expectedValue, $var->computeHash());
        }
    }

    private function computeHash(): array 
    { 
        return [
            [
                [
                    "source_variant_code" => "",
                    "sku" => "",
                    "active" => false,
                    "qty_availability" => [],
                    "price" => 0,
                    "qty" => null
                ],
                "af843aa4584fddc3dc310de4551d9663"
            ],
            [
                [
                    "source_variant_code" => "",
                    "sku" => "",
                    "active" => false,
                    "qty_availability" => [],
                    "price" => 0
                ],
                "af843aa4584fddc3dc310de4551d9663"
            ],
            [
                [
                    "active" => false,
                    "active" => false,
                    "source_variant_code" => "",
                    "sku" => "",
                    "price" => 0,
                    "qty_availability" => []
                ],
                "af843aa4584fddc3dc310de4551d9663"
            ],
            [
                [
                    "source_variant_code" => "source_variant_code",
                    "sku" => "sku",
                    "active" => true,
                    "qty" => null,
                    "qty_availability" => [],
                    "price" => 0,
                    "price_tiers" => [],
                    "barcode" => null,
                    "inventory_management" => null,
                    "grams" => null,
                    "option1" => "",
                    "option2" => "",
                    "option3" => "",
                    "meta" => []
                ],
                "6527001241a102b19f6c935d9e1a5610"
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
                        "source_variant_code" => null,
                        "sku" => null,
                        "active" => null,
                        "barcode" => null,
                        "price" => null
                    ]
                ],
                "fbb4b5245ae825ad9580e352fc849cec"
            ]
        ];
    }
    
}

?>