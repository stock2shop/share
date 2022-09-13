<?php

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
                'channel_variant_code'    => 'x',
                'delete'                => 'false',
                'success'               => 'true',
            ],
        ];
        $c = new DTO\ChannelVariant($mockData);
        $this->assertChannelVariant($c);
        $c->getChannel()->setChannelID(2);
        $c->getChannel()->setSuccess('any string is cast to true...');
        $this->assertChannelVariant($c);
        $c = new DTO\ChannelVariant([]);
        $this->assertChannelNull($c);
    }

    private function assertChannelVariant(DTO\ChannelVariant $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $c->getChannel());
        $this->assertIsInt($c->getChannel()->getChannelID());
        $this->assertIsBool($c->getChannel()->getDelete());
        $this->assertIsBool($c->getChannel()->getSuccess());
        $this->assertIsString($c->getChannel()->getChannelVariantCode());
    }

    private function assertChannelNull(DTO\ChannelVariant $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $c->getChannel());
    }

}
