<?php

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
        $c->setChannelID(2);
        $c->setSuccess('any string is cast to true...');
        $this->assertChannelVariantChannel($c);
        $c = new DTO\ChannelVariantChannel([]);
        $this->assertChannelNull($c);
    }

    private function assertChannelVariantChannel(DTO\ChannelVariantChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $c);
        $this->assertIsInt($c->getChannelID());
        $this->assertIsBool($c->getDelete());
        $this->assertIsBool($c->getSuccess());
        $this->assertIsString($c->getChannelVariantCode());
    }

    private function assertChannelNull(DTO\ChannelVariantChannel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $c);
    }

}
