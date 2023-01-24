<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\PriceTier;

class PriceTierTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "tier" => "tier",
            "price" => "5.90"
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "tier": "tier",
            "price": 5.90
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new PriceTier($this->setUpArray());

        $this->assertSame("tier", $object->tier);
        $this->assertSame(5.90, $object->price);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\PriceTier", $object);

        $object_attributes = [
            "tier",
            "price"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void 
    { 
        $array = PriceTier::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void 
    {
        $json = $this->setUpJson();
        $array = json_encode(PriceTier::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "tier" => "tier_1",
                "price" => 0
            ],
            [
                "tier" => "tier_2",
                "price" => 10.50
            ]
        ];
        $json = json_encode(PriceTier::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>