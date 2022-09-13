<?php

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelProductTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'id'       => '1',
            'channel'  => [
                'channel_id'           => 1,
                'channel_product_code' => 'x',
                'delete'               => 'false',
                'success'              => 'true',
                'synced'               => '2022-02-01',

            ],
            'variants' => [
                [
                    'id'      => 1,
                    'channel' => [
                        'channel_id'           => 1,
                        'channel_variant_code' => 'x',
                        'delete'               => 'false',
                        'success'              => 'true'
                    ]
                ]
            ],
            'images'   => [
                [
                    'id'      => 1,
                    'channel' => [
                        'channel_id'         => 1,
                        'channel_image_code' => 'x',
                        'delete'             => 'false',
                        'success'            => 'true'
                    ]
                ]
            ]
        ];
        $c        = new DTO\ChannelProduct($mockData);
        $this->assertChannelProduct($c);
        $c->getChannel()->setChannelID(1);
        $c->getChannel()->setChannelProductCode('1');
        $c->getChannel()->setDelete('false');
        $c->getChannel()->setSuccess(1);
        $c->getChannel()->setSynced('12454');
        $c->getVariants()[0]->getChannel()->setChannelID(1);
        $c->getVariants()[0]->getChannel()->setChannelVariantCode('1');
        $c->getVariants()[0]->getChannel()->setDelete(0);
        $c->getVariants()[0]->getChannel()->setSuccess(1);
        $c->getImages()[0]->getChannel()->setChannelID(1);
        $c->getImages()[0]->getChannel()->setChannelImageCode('1');
        $c->getImages()[0]->getChannel()->setDelete(false);
        $c->getImages()[0]->getChannel()->setSuccess('any string is cast to true...');
        $this->assertChannelProduct($c);
        $c = new DTO\ChannelProduct([]);
        $this->assertChannelProductNull($c);
    }

    private function assertChannelProduct(DTO\ChannelProduct $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->getChannel());
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductChannel', $c->getChannel());
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->getVariants()[0]->getChannel());
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $c->getVariants()[0]->getChannel());
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemVariant', $c->getVariants()[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->getImages()[0]->getChannel());
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $c->getImages()[0]->getChannel());
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemImage', $c->getImages()[0]);
        $this->assertIsInt($c->getChannel()->getChannelID());
        $this->assertIsString($c->getChannel()->getChannelProductCode());
        $this->assertIsBool($c->getChannel()->getDelete());
        $this->assertIsBool($c->getChannel()->getSuccess());
        $this->assertIsString($c->getChannel()->getSynced());
        $this->assertFalse($c->getChannel()->getDelete());
        $this->assertTrue($c->getChannel()->getSuccess());
        $this->assertIsInt($c->getVariants()[0]->getChannel()->getChannelID());
        $this->assertIsString($c->getVariants()[0]->getChannel()->getChannelVariantCode());
        $this->assertIsBool($c->getVariants()[0]->getChannel()->getDelete());
        $this->assertIsBool($c->getVariants()[0]->getChannel()->getSuccess());
        $this->assertFalse($c->getVariants()[0]->getChannel()->getDelete());
        $this->assertTrue($c->getVariants()[0]->getChannel()->getSuccess());
        $this->assertIsInt($c->getImages()[0]->getChannel()->getChannelID());
        $this->assertIsString($c->getImages()[0]->getChannel()->getChannelImageCode());
        $this->assertIsBool($c->getImages()[0]->getChannel()->getDelete());
        $this->assertIsBool($c->getImages()[0]->getChannel()->getSuccess());
        $this->assertFalse($c->getImages()[0]->getChannel()->getDelete());
        $this->assertTrue($c->getImages()[0]->getChannel()->getSuccess());
    }

    private function assertChannelProductNull(DTO\ChannelProduct $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->getChannel());
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductChannel', $c->getChannel());
        $this->assertNull($c->getChannel()->getChannelID());
        $this->assertEmpty($c->getVariants());
        $this->assertEmpty($c->getImages());
    }
}
