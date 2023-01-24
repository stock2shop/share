<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ChannelImage;

class ChannelImageTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "active" => "true",
            "channel_id" => "719",
            "channel_image_code" => "",
            "delete" => "false",
            "id" => "29",
            "success" => "true"
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '
        [
            {
                "src":null,
                "active":true,
                "channel_id":719,
                "channel_image_code":"",
                "delete":false,
                "id":29,
                "success":true
            },
            {
                "src":null,
                "active":false,
                "channel_id":1023,
                "channel_image_code":null,
                "delete":null,
                "id":null,
                "success":null
            }
        ]';
        return $json;
    }
    
    public function testClassConstructor()
    {
        $array = $this->setUpArray();

        $object = new ChannelImage($array);

        $this->assertSame(true, $object->active);
        $this->assertSame(719, $object->channel_id);
        $this->assertSame("", $object->channel_image_code);
        $this->assertSame(false, $object->delete);
        $this->assertSame(29, $object->id);
        $this->assertSame(true, $object->success);
    }

    public function testJsonConversion(): void
    {
        $json = '
        {
            "src":null,
            "active":true,
            "channel_id":719,
            "channel_image_code":"",
            "delete":false,
            "id":29,
            "success":true
        }';
        $data = json_encode(ChannelImage::createFromJSON($json));
        $this->assertJsonStringEqualsJsonString($json, $data);
    }

    public function testArrayConversion(): void
    {
        $array = [
            ["active" => "true","channel_id" => "719","channel_image_code" => "","delete" => "false","id" => "29","success" => "true"],
            ["active" => "false", "channel_id" => "1023"]
        ];

        $data = json_encode(ChannelImage::createArray($array));

        $json = $this->setUpJson();

        $this->assertJsonStringEqualsJsonString($json, $data);
    }

    public function testObject()
    {
        $data = new ChannelImage($this->setUpArray());
        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelImage", $data);

        $object_attributes = [
            "active",
            "channel_id",
            "channel_image_code",
            "delete",
            "id",
            "success"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $data);
        }
    }
}

?>