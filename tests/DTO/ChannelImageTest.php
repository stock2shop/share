<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelImageTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "src": "src",
            "active": true,
            "channel_id": 57,
            "channel_image_code": "channel_image_code",
            "delete": false,
            "id": 1,
            "success": true
        }';
    }

    public function testSerialize(): void
    {
        $ci = DTO\ChannelImage::createFromJSON($this->json);
        $serialized = json_encode($ci);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $ci = DTO\ChannelImage::createFromJSON($this->json);
        $this->assertChannelImage($ci);
    }


    private function assertChannelImage(DTO\ChannelImage $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImage', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
    }
}
