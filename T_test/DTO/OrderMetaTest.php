<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\OrderMeta;

class OrderMetaTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "key" => "key",
            "value" => "value"
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "key": "key",
            "value": "value"
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new OrderMeta($this->setUpArray());

        $this->assertSame("key", $object->key);
        $this->assertSame("value", $object->value);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\OrderMeta", $object);

        $object_attributes = [
            "key",
            "value"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(OrderMeta::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "key" => "key",
                "value" => "value"
            ],
            [
                "key" => "key_1",
                "value" => "value_1"
            ]
        ];
        $json = json_encode(OrderMeta::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>