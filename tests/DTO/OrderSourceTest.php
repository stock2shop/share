<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\OrderSource;

class OrderSourceTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "source_id" => "0",
            "source_customer_code" => "",
            "source_order_code" => "source_order_code"
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "source_id": 0,
            "source_customer_code": "",
            "source_order_code": "source_order_code"
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new OrderSource($this->setUpArray());

        $this->assertSame(0, $object->source_id);
        $this->assertSame("", $object->source_customer_code);
        $this->assertSame("source_order_code", $object->source_order_code);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\OrderSource", $object);

        $object_attributes = [
            "source_id",
            "source_customer_code",
            "source_order_code"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(OrderSource::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "source_id" => 0,
                "source_customer_code" => "",
                "source_order_code" => "source_order_code"
            ],
            [
                "source_id" => 10,
                "source_customer_code" => "source_customer_code",
                "source_order_code" => "source_order_code"
            ]
        ];
        $json = json_encode(OrderSource::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>