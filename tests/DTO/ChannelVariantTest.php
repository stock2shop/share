<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelVariantTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'channel'  => [
                'channel_id'            => 1,
                'channel_variant_code'  => 'x',
                'delete'                => 'false',
                'success'               => 'true',
            ],
        ];
        $c = new DTO\ChannelVariant($mockData);
        $this->assertChannelVariant($c);
        $c = new DTO\ChannelVariant([]);
        $this->assertChannelVariantNull($c);
    }

    private function assertChannelVariant(DTO\ChannelVariant $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariant', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->channel);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $c->channel);
        $this->assertEquals(true, $c->channel->success);
        $this->assertEquals(false, $c->channel->delete);
    }

    private function assertChannelVariantNull(DTO\ChannelVariant $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariant', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->channel);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $c->channel);
    }

}
