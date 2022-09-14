<?php
declare(strict_types=1);

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
        $c = new DTO\ChannelImage([]);
        $this->assertChannelImageNull($c);
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
