<?php

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelImageTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'channel'  => [
                'channel_id'            => 1,
                'channel_image_code'    => 'x',
                'delete'                => 'false',
                'success'               => 'true',
            ],
        ];
        $c = new DTO\ChannelImage($mockData);
        $this->assertChannelImage($c);
        $c->getChannel()->setChannelID(2);
        $c->getChannel()->setSuccess('any string is cast to true...');
        $this->assertChannelImage($c);
        $c = new DTO\ChannelImage([]);
        $this->assertChannelNull($c);
    }

    private function assertChannelImage(DTO\ChannelImage $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $c->getChannel());
        $this->assertIsInt($c->getChannel()->getChannelID());
        $this->assertIsBool($c->getChannel()->getDelete());
        $this->assertIsBool($c->getChannel()->getSuccess());
        $this->assertIsString($c->getChannel()->getChannelImageCode());
    }

    private function assertChannelNull(DTO\ChannelImage $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $c->getChannel());
    }

}
