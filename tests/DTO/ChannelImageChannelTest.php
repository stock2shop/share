<?php

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
            'success'               => 'true',
        ];
        $c = new DTO\ChannelImageChannel($mockData);
        $this->assertChannelImageChannel($c);
        $c->setChannelID(2);
        $c->setSuccess('any string is cast to true...');
        $this->assertChannelImageChannel($c);
        $c = new DTO\ChannelImageChannel([]);
        $this->assertChannelNull($c);
    }

    private function assertChannelImageChannel(DTO\ChannelImageChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $c);
        $this->assertIsInt($c->getChannelID());
        $this->assertIsBool($c->getDelete());
        $this->assertIsBool($c->getSuccess());
        $this->assertIsString($c->getChannelImageCode());
    }

    private function assertChannelNull(DTO\ChannelImageChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $c);
    }

}
