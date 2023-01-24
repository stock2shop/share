<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ChannelImageChannel;

class ChannelImageChannelTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "channel_id" => "90",
            "channel_image_code" => "0",
            "delete" => "false",
            "success" => "true"
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '
        {
            "channel_id": 90,
            "channel_image_code": "0",
            "delete": false,
            "success": true
        }';
        return $json;
    }

    public function testClassConstructor(): void
    {
        $array = $this->setUpArray();
        $object = new ChannelImageChannel($array);

        $this->assertSame(90, $object->channel_id);
        $this->assertSame("0", $object->channel_image_code);
        $this->assertSame(false, $object->delete);
        $this->assertSame(true, $object->success);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelImageChannel", $object);

        $object_attributes = [
            "channel_id",
            "channel_image_code",
            "delete",
            "success"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }

    }
    public function testHasSynced(): void
    {
        $object = new ChannelImageChannel($this->setUpArray());
        $result = $object->hasSyncedToChannel();
        $this->assertSame(true, $result);
    }

    public function testJsonConversion(): void
    {
        $json = $this->setUpJson();
        $object = json_encode(ChannelImageChannel::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $object);
    }

    public function testArrayConversion(): void
    {
        $array = [
            ["channel_id" => "90", "channel_image_code" => "0", "delete" => "false", "success" => "true"],
            ["channel_id" => "57", "channel_image_code" => "0", "delete" => "true", "success" => "false"]
        ];
        $object = json_encode(ChannelImageChannel::createArray($array));

        $json = '
        [
            {
              "channel_id": 90,
              "channel_image_code": "0",
              "delete": false,
              "success": true
            },
            {
              "channel_id": 57,
              "channel_image_code": "0",
              "delete": true,
              "success": false
            }
        ]';
        $this->assertJsonStringEqualsJsonString($json, $object);
    }
    
    public function testSerialize(): void
    {
        $array = ChannelImageChannel::createArray($this->setUpArray())[0];

        $result = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $result);
    }
}

?>