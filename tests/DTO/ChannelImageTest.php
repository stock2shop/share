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
            "src": "source1",
            "id": 1,
            "active": true,
            "channel": {
                "channel_id": 123,
                "channel_image_code": "image_code_abc",
                "delete": false,
                "success": true
            }
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
        $ci = new DTO\ChannelImage([]);
        $this->assertChannelImageNull($ci);
    }


    private function assertChannelImage(DTO\ChannelImage $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImage', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->channel);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $c->channel);
    }

    private function assertChannelImageNull(DTO\ChannelImage $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImage', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->channel);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $c->channel);
    }

}
