<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelVariantChannelTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "channel_id": 123,
            "channel_variant_code": "variant_code_abc",
            "delete": false,
            "success": true
        }';
    }

    public function testSerialize(): void
    {
        $ci = DTO\ChannelVariantChannel::createFromJSON($this->json);
        $serialized = json_encode($ci);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $ci = DTO\ChannelVariantChannel::createFromJSON($this->json);
        $this->assertChannelVariantChannel($ci);
        $ci = new DTO\ChannelVariantChannel([]);
        $this->assertChannelVariantChannelNull($ci);
    }

    private function assertChannelVariantChannel(DTO\ChannelVariantChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $c);
        $this->assertEquals(true, $c->success);
        $this->assertEquals(false, $c->delete);
    }

    private function assertChannelVariantChannelNull(DTO\ChannelVariantChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $c);
    }
}
