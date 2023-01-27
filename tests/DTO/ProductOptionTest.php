<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ProductOption;

class ProductOptionTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "name" => "Outfit",
            "position" => 0
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "name": "Outfit",
            "position": 0
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new ProductOption($this->setUpArray());
        
        $this->assertSame("Outfit", $object->name);
        $this->assertSame(0, $object->position);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\ProductOption", $object);

        $object_attributes = [
            "name",
            "position"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void 
    { 
        $array = ProductOption::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(ProductOption::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "name" => "Outfit",
                "position" => 0
            ],
            [
                "name" => "Color",
                "position" => 1
            ]
        ];
        $json = json_encode(ProductOption::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>