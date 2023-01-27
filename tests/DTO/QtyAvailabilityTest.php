<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\QtyAvailability;

class QtyAvailabilityTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "description" => "",
            "qty" => "5.0"
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "description": "",
            "qty": 5.0
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new QtyAvailability($this->setUpArray());

        $this->assertSame("", $object->description);
        $this->assertSame(5.0, $object->qty);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\QtyAvailability", $object);

        $object_attributes = [
            "description",
            "qty"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void 
    { 
        $qty_availability = new QtyAvailability([
            "description" => "description",
            "qty" => "0"
        ]);
        $expectedResult = '
        {
            "description": "description",
            "qty": 0
        }';
        $json = json_encode($qty_availability);
        $this->assertJsonStringEqualsJsonString($expectedResult, $json);
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(QtyAvailability::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "description" => "description",
                "qty" => 5
            ],
            [
                "description" => "description_2",
                "qty" => 10
            ]
        ];
        $json = json_encode(QtyAvailability::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>