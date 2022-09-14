<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelProductChannelTest extends TestCase
{
    public function testConstruct()

    {
        $mockData = [
            'channel_id'            => 1,
            'channel_product_code'  => 'x',
            'delete'                => 'false',
            'success'               => true,
            'synced'                => 'true'
        ];
        $c = new DTO\ChannelProductChannel($mockData);
        $this->assertChannelProductChannel($c);
        $c = new DTO\ChannelProductChannel([]);
        $this->assertChannelNull($c);
    }
    private function assertChannelProductChannel(DTO\ChannelProductChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductChannel', $c);
        $this->assertEquals(true, $c->hasSyncedToChannel());
    }

    private function assertChannelNull(DTO\ChannelProductChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductChannel', $c);
    }

}