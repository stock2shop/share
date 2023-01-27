<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\Meta;

class MetaTest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "key" => "key",
            "value" => "value",
            "template_name" => "template_name"
        ];
        return $array;
    }

    private function setUpJson(): string
    { 
        $json = '{
            "key": "key",
            "value": "value",
            "template_name":"template_name"
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new Meta($this->setUpArray());

        $this->assertSame("key", $object->key);
        $this->assertSame("value", $object->value);
        $this->assertSame("template_name", $object->template_name);


        $this->assertInstanceOf("Stock2Shop\Share\DTO\Meta", $object);

        $object_attributes = [
            "key",
            "value",
            "template_name"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(Meta::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }
    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "key" => "key_1",
                "value" => "value_1",
                "template_name" => "template_name_1"
            ],
            [
                "key" => "key",
                "value" => "value",
                "template_name" => "template_name"
            ]
        ];

        $json = '[{
            "key": "key_1",
            "value": "value_1",
            "template_name":"template_name_1"
        }, 
        {
            "key": "key",
            "value": "value",
            "template_name":"template_name"
        }]';

        $json = json_encode(Meta::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>