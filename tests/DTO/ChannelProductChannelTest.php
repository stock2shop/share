<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelProductChannelTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "channel_id": 56,
            "channel_product_code": "channel_product_code",
            "delete": false,
            "success": true,
            "synced": "2022-02-03"
        }';
    }

    public function testSerialize(): void
    {
        $cpc = DTO\ChannelProductChannel::createFromJSON($this->json);
        $serialized = json_encode($cpc);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $cpc = DTO\ChannelProductChannel::createFromJSON($this->json);
        $this->assertChannelProductChannel($cpc);
        $cpc = new DTO\ChannelProductChannel([]);
        $this->assertChannelProductChannelNull($cpc);
    }

    private function assertChannelProductChannel(DTO\ChannelProductChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductChannel', $c);
        $this->assertEquals(true, $c->hasSyncedToChannel());
    }

    private function assertChannelProductChannelNull(DTO\ChannelProductChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductChannel', $c);
    }

}
