<?php

namespace Stock2Shop\Tests\Share\DTO;

use phpDocumentor\Reflection\Type;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelProductsTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'channel_products' => [
                [
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
                ],
                [
                    'id'       => '2',
                    'channel'  => [
                        'channel_id'           => 2,
                        'channel_product_code' => 'x',
                        'delete'               => 'false',
                        'success'              => 'true',
                        'synced'               => '2022-02-02',

                    ],
                    'variants' => [
                        [
                            'id'      => 2,
                            'channel' => [
                                'channel_id'           => 2,
                                'channel_variant_code' => 'x',
                                'delete'               => 'false',
                                'success'              => 'true'
                            ]
                        ]
                    ],
                    'images'   => [
                        [
                            'id'      => 2,
                            'channel' => [
                                'channel_id'         => 2,
                                'channel_image_code' => 'x',
                                'delete'             => 'false',
                                'success'            => 'true'
                            ]
                        ]
                    ]
                ],
            ]
        ];
        $c        = new DTO\ChannelProducts($mockData);
        $channelProducts = $c->getChannelProducts();
        $this->assertChannelProducts($c);
        foreach ($channelProducts as $cp) {
            $cp->getChannel()->setChannelID(2);
            $cp->getChannel()->setChannelProductCode('1');
            $cp->getChannel()->setDelete('false');
            $cp->getChannel()->setSuccess(1);
            $cp->getChannel()->setSynced('12454');
            $cp->getVariants()[0]->getChannel()->setChannelID(3);
            $cp->getVariants()[0]->getChannel()->setChannelVariantCode('3');
            $cp->getVariants()[0]->getChannel()->setDelete(0);
            $cp->getVariants()[0]->getChannel()->setSuccess(1);
            $cp->getImages()[0]->getChannel()->setChannelID(3);
            $cp->getImages()[0]->getChannel()->setChannelImageCode('3');
            $cp->getImages()[0]->getChannel()->setDelete(false);
            $cp->getImages()[0]->getChannel()->setSuccess('any string is cast to true...');
            $this->assertChannelProducts($c);
        }

        $c = new DTO\ChannelProducts([]);
        $this->assertChannelProductsNull($c);
    }

    private function assertChannelProducts(DTO\ChannelProducts $c)
    {
        $channelProducts = $c->getChannelProducts();
        foreach ($channelProducts as $cp) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->getChannel());
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductChannel', $cp->getChannel());
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $cp);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->getVariants()[0]->getChannel());
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $cp->getVariants()[0]->getChannel());
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemVariant', $cp->getVariants()[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->getImages()[0]->getChannel());
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $cp->getImages()[0]->getChannel());
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemImage', $cp->getImages()[0]);
            $this->assertIsInt($cp->getChannel()->getChannelID());
            $this->assertIsString($cp->getChannel()->getChannelProductCode());
            $this->assertIsBool($cp->getChannel()->getDelete());
            $this->assertIsBool($cp->getChannel()->getSuccess());
            $this->assertIsString($cp->getChannel()->getSynced());
            $this->assertFalse($cp->getChannel()->getDelete());
            $this->assertTrue($cp->getChannel()->getSuccess());
            $this->assertIsInt($cp->getVariants()[0]->getChannel()->getChannelID());
            $this->assertIsString($cp->getVariants()[0]->getChannel()->getChannelVariantCode());
            $this->assertIsBool($cp->getVariants()[0]->getChannel()->getDelete());
            $this->assertIsBool($cp->getVariants()[0]->getChannel()->getSuccess());
            $this->assertFalse($cp->getVariants()[0]->getChannel()->getDelete());
            $this->assertTrue($cp->getVariants()[0]->getChannel()->getSuccess());
            $this->assertIsInt($cp->getImages()[0]->getChannel()->getChannelID());
            $this->assertIsString($cp->getImages()[0]->getChannel()->getChannelImageCode());
            $this->assertIsBool($cp->getImages()[0]->getChannel()->getDelete());
            $this->assertIsBool($cp->getImages()[0]->getChannel()->getSuccess());
            $this->assertFalse($cp->getImages()[0]->getChannel()->getDelete());
            $this->assertTrue($cp->getImages()[0]->getChannel()->getSuccess());
        }
    }

    private function assertChannelProductsNull(DTO\ChannelProducts $c)
    {
        $channelProducts = $c->getChannelProducts();
        foreach ($channelProducts as $cp) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->getChannel());
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductsChannel', $cp->getChannel());
            $this->assertNull($cp->getChannel()->getChannelID());
            $this->assertEmpty($cp->getVariants());
            $this->assertEmpty($cp->getImages());
        }

    }
}
