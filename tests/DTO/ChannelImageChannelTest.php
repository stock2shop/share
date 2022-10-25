<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelImageChannelTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "channel_id": 1,
            "channel_image_code": "channel_image_code_abc",
            "delete": false,
            "success": true
        }';
    }

    public function testSerialize(): void
    {
        $cic = DTO\ChannelImageChannel::createFromJSON($this->json);
        $serialized = json_encode($cic);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $cic = DTO\ChannelImageChannel::createFromJSON($this->json);
        $this->assertChannelImageChannel($cic);
    }

    private function assertChannelImageChannel(DTO\ChannelImageChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $c);
        $this->assertEquals(false, $c->delete);
        $this->assertEquals(true, $c->success);
    }
}
