<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\OrderShippingLine;

class OrderShippingLineTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "price" => "0",
            "title" => "title"
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "price": 0.0,
            "title": "title"
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new OrderShippingLine($this->setUpArray());

        $this->assertSame(0.0, $object->price);
        $this->assertSame("title", $object->title);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\OrderShippingLine", $object);

        $object_attributes = [
            "price",
            "title"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testJsonConversion(): void 
    {
        $json = $this->setUpJson();
        $array = json_encode(OrderShippingLine::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void
    { 
        $array = [
            [
                "price" => 15.5,
                "title" => "title"
            ],
            [
                "price" => 10,
                "title" => "title"
            ]
        ];
        $json = json_encode(OrderShippingLine::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>