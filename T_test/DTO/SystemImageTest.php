<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\SystemImage;

class SystemImageTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "id" => "0",
            "active" => "true",
            "src" => ""
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "id": 0,
            "active": true,
            "src": ""
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new SystemImage($this->setUpArray());

        $this->assertSame(0, $object->id);
        $this->assertSame(true, $object->active);
        $this->assertSame("", $object->src);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemImage", $object);

        $object_attributes = [
            "id",
            "active",
            "src"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void 
    { 
        $array = SystemImage::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(SystemImage::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "id" => 10,
                "active" => true,
                "src" => ""
            ],
            [
                "id" => 52,
                "active" => false,
                "src" => ""
            ]
        ];

        $json = json_encode(SystemImage::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>