<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemProductsTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'system_products' =>
                [
                    [
                        'id'       => '1',
                        'options' => [
                            [
                                'name' => 'name',
                                'position' => 1
                            ]
                        ],
                        'meta' => [
                            [
                                'key' => 'key 1',
                                'value' => 'value 1',
                                'template_name' => 'template_name 1'
                            ]
                        ],
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
                                'src'     => 'x',
                                'channel' => [
                                    'channel_id'         => 1,
                                    'channel_image_code' => 'x',
                                    'delete'             => 'false',
                                    'success'            => 'true'
                                ]
                            ]
                        ],
                        'client_id' => 21,
                        'hash' => 'hash 1',
                        'source_id' => 57,
                        'source_product_code' => 'x',
                        'modified' => 'now',
                        'created' => 'now'
                    ],
                    [
                        'id'       => '2',
                        'options' => [
                            [
                                'name' => 'name',
                                'position' => 2
                            ]
                        ],
                        'meta' => [
                            [
                                'key' => 'key 2',
                                'value' => 'value 2',
                                'template_name' => 'template_name 2'
                            ]
                        ],
                        'channel'  => [
                            'channel_id'           => 2,
                            'channel_product_code' => 'x',
                            'delete'               => 'false',
                            'success'              => 'true',
                            'synced'               => '2022-02-01',

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
                                'src'     => 'x',
                                'channel' => [
                                    'channel_id'         => 2,
                                    'channel_image_code' => 'x',
                                    'delete'             => 'false',
                                    'success'            => 'true'
                                ]
                            ]
                        ],
                        'client_id' => 21,
                        'hash' => 'hash 1',
                        'source_id' => 57,
                        'source_product_code' => 'x',
                        'modified' => 'now',
                        'created' => 'now'
                    ]
                ]

        ];
        $c        = new DTO\SystemProducts($mockData);
        $this->assertSystemProducts($c);
        $c = new DTO\SystemProducts([]);
        $this->assertSystemProductsNull($c);
    }

    private function assertSystemProducts(DTO\SystemProducts $c)
    {
        foreach ($c->getSystemProducts() as $sp) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $sp);
            foreach ($sp->getMeta() as $meta) {
                $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $meta);
                $this->assertIsString($meta->getKey());
                $this->assertIsString($meta->getValue());
                $this->assertIsString($meta->getTemplateName());
            }
            foreach ($sp->getOptions() as $option) {
                $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $option);
                $this->assertIsString($option->getName());
                $this->assertIsInt($option->getPosition());
            }
            foreach ($sp->getImages() as $image) {
                $this->assertInstanceOf('Stock2Shop\Share\DTO\Image', $image);
                $this->assertIsString($image->getSrc());
            }
            foreach ($sp->getChannels() as $channel) {
                $this->assertInstanceOf('Stock2Shop\Share\DTO\Channel', $channel);
                $this->assertIsInt($channel->getID());
                $this->assertIsInt($channel->getClientID());
                $this->assertIsBool($channel->getActive());
                $this->assertIsString($channel->getCreated());
                $this->assertIsString($channel->getModified());
                $this->assertIsString($channel->getDescription());
                $this->assertIsString($channel->getPriceTier());
                $this->assertIsString($channel->getQtyAvailability());
                $this->assertIsString($channel->getSyncToken());
            }
            foreach ($sp->getVariants() as $variant) {
                $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemVariant', $variant);
            }
            $this->assertIsInt($sp->getID());
            $this->assertIsInt($sp->getClientID());
            $this->assertIsInt($sp->getSourceID());
            $this->assertIsString($sp->getSourceProductCode());
            $this->assertIsString($sp->getModified());
            $this->assertIsString($sp->getCreated());
            $this->assertIsString($sp->getHash());
        }
    }

    private function assertSystemProductsNull(DTO\SystemProducts $c)
    {
        foreach ($c->getSystemProducts() as $sp) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $sp);
            $this->assertEmpty($sp->getOptions());
            $this->assertEmpty($sp->getMeta());
        }

    }
}
