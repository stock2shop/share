<?php
declare(strict_types=1);

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
        $c = new DTO\ChannelProduct([]);
        $this->assertChannelProductNull($c);
    }

    private function assertChannelProduct(DTO\ChannelProduct $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->channel);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductChannel', $c->channel);
        $this->assertIsArray($c->variants);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->variants[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemVariant', $c->variants[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->variants[0]->channel);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $c->variants[0]->channel);
        $this->assertIsArray($c->images);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->images[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemImage', $c->images[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->images[0]->channel);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $c->images[0]->channel);
    }

    private function assertChannelProductNull(DTO\ChannelProduct $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->channel);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductChannel', $c->channel);
        $this->assertIsArray($c->variants);
        $this->assertIsArray($c->images);
    }
}
