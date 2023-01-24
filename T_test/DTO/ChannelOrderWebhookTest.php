<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ChannelOrderWebhook;

class ChannelOrderWebhookTest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "storage_code" => "asasld_2323_asdasd",
            "payload" => ""
        ];
        return $array;
    }

    private function setUpJson(): string
    { 
        $json = '{
            "storage_code": "asasld_2323_asdasd",
            "payload": ""
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new ChannelOrderWebhook($this->setUpArray());
        $this->assertSame("asasld_2323_asdasd", $object->storage_code);
        $this->assertSame("", $object->payload);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelOrderWebhook", $object);

        $object_attributes = [
            "storage_code",
            "payload"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    // public function testSerialize(): void { }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(ChannelOrderWebhook::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "storage_code" => "asasld_2323_asdasd",
                "payload" => ""
            ],
            [
                "storage_code" => "",
                "payload" => ""
            ]
        ];
        $json = json_encode(ChannelOrderWebhook::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>