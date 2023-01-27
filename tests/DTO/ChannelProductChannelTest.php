<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ChannelProductChannel;

class ChannelProductChannelTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "channel_id" => "",
            "channel_product_code" => "",
            "delete" => "false",
            "success" => "false",
            "synced" => "true"
        ];
        return $array;
    }

    private function setUpJson(): string
    { 
        $json = '{
            "channel_id": null,
            "channel_product_code": "",
            "delete": false,
            "success": false,
            "synced": "true"
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new ChannelProductChannel($this->setUpArray());
        $this->assertSame(null, $object->channel_id);
        $this->assertSame("", $object->channel_product_code);
        $this->assertSame(false, $object->delete);
        $this->assertSame(false, $object->success);
        $this->assertSame("true", $object->synced);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelProductChannel", $object);

        $object_attributes = [
            "channel_id",
            "channel_product_code",
            "delete",
            "success",
            "synced"
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
        $array = json_encode(ChannelProductChannel::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "channel_id" => null,
                "channel_product_code" => "",
                "delete" => false,
                "success" => false,
                "synced" => "true"
            ],
            [
                "channel_id" => 59,
                "channel_product_code" => "",
                "delete" => true,
                "success" => true,
                "synced" => "true"
            ]
        ];
        $json = json_encode(ChannelProductChannel::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>