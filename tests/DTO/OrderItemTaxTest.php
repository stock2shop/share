<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\OrderItemTax;

class OrderItemTaxTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "price" => "20.0",
            "title" => "",
            "rate" => "3.42"
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "price": 20.0,
            "title": "",
            "rate": 3.42
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new OrderItemTax($this->setUpArray());

        $this->assertSame(20.0, $object->price);
        $this->assertSame("", $object->title);
        $this->assertSame(3.42, $object->rate);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\OrderItemTax", $object);

        $object_attributes = [
            "price",
            "title",
            "rate"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void
    {
        $array = OrderItemTax::createArray($this->setUpArray())[0];

        $result = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $result);
    }

    public function testJsonConversion(): void
    { 
        $json = $this->setUpJson();
        $array = json_encode(OrderItemTax::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void
    { 
        $array = [
            [
                "price" => 20.0,
                "title" => "",
                "rate" => 3.42
            ],
            [
                "price" => 205.0,
                "title" => "",
                "rate" => 4.42
            ]
        ];
        $json = json_encode(OrderItemTax::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>