<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ChannelVariantChannel;

class ChannelVariantChannelTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "channel_id" => "",
            "channel_variant_code" => "",
            "delete" => "true",
            "success" => "false"
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "channel_id": null,
            "channel_variant_code": "",
            "delete": true,
            "success": false
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new ChannelVariantChannel($this->setUpArray());

        $this->assertSame(null, $object->channel_id);
        $this->assertSame("", $object->channel_variant_code);
        $this->assertSame(true, $object->delete);
        $this->assertSame(false, $object->success);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelVariantChannel", $object);

        $object_attributes = [
            "channel_id",
            "channel_variant_code",
            "delete",
            "success"
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
        $array = json_encode(ChannelVariantChannel::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "channel_id" => 0,
                "channel_variant_code" => "",
                "delete" => true,
                "success" => false
            ],
            [
                "channel_id" => 0,
                "channel_variant_code" => "",
                "delete" => false,
                "success" => true
            ]
        ];
        $json = json_encode(ChannelVariantChannel::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testHasSynced(): void
    {
        $object = new ChannelVariantChannel($this->setUpArray());

        $this->assertSame(false, $object->hasSyncedToChannel());
    }
    
    
    
}

?>