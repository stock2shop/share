<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelImageChannelTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'channel_id'            => 1,
            'channel_image_code'    => 'x',
            'delete'                => 'false',
            'success'               => false,
        ];
        $c = new DTO\ChannelImageChannel($mockData);
        $this->assertChannelImageChannel($c);
        $c = new DTO\ChannelImageChannel([]);
        $this->assertChannelNull($c);
    }

    private function assertChannelImageChannel(DTO\ChannelImageChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $c);
        $this->assertEquals(false, $c->delete);
        $this->assertEquals(false, $c->success);
    }

    private function assertChannelNull(DTO\ChannelImageChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $c);
    }

}
