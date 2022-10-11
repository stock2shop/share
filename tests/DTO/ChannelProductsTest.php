<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelProductsTest extends TestCase
{
    public function testConstruct()
    {
        $mockData                                 = [
            'channel_products' => [
                [
                    'id'                   => '1',
                    'channel_id'           => 1,
                    'channel_product_code' => 'x',
                    'delete'               => 'false',
                    'success'              => 'true',
                    'synced'               => '2022-02-01',
                    'variants' => [
                        [
                            'id'                   => 1,
                            'channel_id'           => 1,
                            'channel_variant_code' => 'x',
                            'delete'               => 'false',
                            'success'              => 'true'
                        ]
                    ],
                    'images'   => [
                        [
                            'id'                 => 1,
                            'channel_id'         => 1,
                            'channel_image_code' => 'x',
                            'delete'             => 'false',
                            'success'            => 'true'
                        ]
                    ]
                ],
                [
                    'id'                   => '2',
                    'channel_id'           => 2,
                    'channel_product_code' => 'x',
                    'delete'               => 'false',
                    'success'              => 'true',
                    'synced'               => '2022-02-02',
                    'variants' => [
                        [
                            'id'                   => 2,
                            'channel_id'           => 2,
                            'channel_variant_code' => 'x',
                            'delete'               => 'false',
                            'success'              => 'true'
                        ]
                    ],
                    'images'   => [
                        [
                            'id'                 => 2,
                            'channel_id'         => 2,
                            'channel_image_code' => 'x',
                            'delete'             => 'false',
                            'success'            => 'true'
                        ]
                    ]
                ],
            ]
        ];
        $c                                        = new DTO\ChannelProducts($mockData);
        $c->channel_products[0]->success = true;
        $this->assertChannelProducts($c);
        $c = new DTO\ChannelProducts([]);
        $this->assertChannelProductsNull($c);
    }

    private function assertChannelProducts(DTO\ChannelProducts $c)
    {
        $channelProducts = $c->channel_products;
        foreach ($channelProducts as $cp) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Product', $cp);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp);
            $this->assertIsArray($cp->variants);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->variants[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Variant', $cp->variants[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->variants[0]);
            $this->assertIsArray($cp->images);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->images[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Image', $cp->images[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->images[0]);
        }
    }

    private function assertChannelProductsNull(DTO\ChannelProducts $c)
    {
        $channelProducts = $c->channel_products;
        foreach ($channelProducts as $cp) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $cp);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp);
            $this->assertIsArray($cp->variants);
            $this->assertIsArray($cp->images);
        }
    }
}
