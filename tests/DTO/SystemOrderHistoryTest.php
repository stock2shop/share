<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\SystemOrderHistory;

class SystemOrderHistoryTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "instruction" => "instruction",
            "storage_code" => "",
            "created" => "",
            "modified" => "modified"
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "instruction": "instruction",
            "storage_code": "",
            "created": "",
            "modified": "modified"
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    {
        $object = new SystemOrderHistory($this->setUpArray());

        $this->assertSame("instruction", $object->instruction);
        $this->assertSame("", $object->storage_code);
        $this->assertSame("", $object->created);
        $this->assertSame("modified", $object->modified);


        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemOrderHistory", $object);

        $object_attributes = [
            "created",
            "modified",
            "instruction",
            "storage_code"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void 
    { 
        $array = SystemOrderHistory::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(SystemOrderHistory::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "instruction" => "instruction",
                "storage_code" => "",
                "created" => "",
                "modified" => "modifed"
            ],
            [
                "instruction" => "instruction",
                "storage_code" => "storage_code",
                "created" => "created_date",
                "modified" => "modifed"
            ]
        ];
        $json = json_encode(SystemOrderHistory::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>