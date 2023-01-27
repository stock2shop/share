<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\Segment;

class SegmentTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "type" => "products",
            "key" => "vendor",
            "operator" => "contains",
            "value" => "Mihoyo",
            "owner" => "system"
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "type": "products",
            "key": "vendor",
            "operator": "contains",
            "value": "Mihoyo",
            "owner": "system"
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new Segment($this->setUpArray());

        $this->assertSame("products", $object->type);
        $this->assertSame("vendor", $object->key);
        $this->assertSame("contains", $object->operator);
        $this->assertSame("Mihoyo", $object->value);
        $this->assertSame("system", $object->owner);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\Segment", $object);

        $object_attributes = [
            "type",
            "key",
            "key",
            "value",
            "owner"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }
    
    public function testSerialize(): void 
    { 
        $array = Segment::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(Segment::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void
    { 
        $array = [
            [
                "type" => "products",
                "key" => "vendor",
                "operator" => "contains",
                "value" => "Mihoyo",
                "owner" => "system"
            ],
            [
                "type" => "customer",
                "key" => "email",
                "operator" => "equal",
                "value" => "keenan.asterisk@gmail.com",
                "owner" => "system"
            ]
        ];
        $json = json_encode(Segment::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>