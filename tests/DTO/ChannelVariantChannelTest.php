<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelVariantChannelTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'channel_id'            => 1,
            'channel_variant_code'  => 'x',
            'delete'                => 'false',
            'success'               => 'true',
        ];
        $c = new DTO\ChannelVariantChannel($mockData);
        $this->assertChannelVariantChannel($c);
        $c = new DTO\ChannelVariantChannel([]);
        $this->assertChannelNull($c);
    }

    private function assertChannelVariantChannel(DTO\ChannelVariantChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $c);
        $this->assertEquals(true, $c->success);
        $this->assertEquals(false, $c->delete);
    }

    private function assertChannelNull(DTO\ChannelVariantChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $c);
    }
}
