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
                        'channels'  => [
                            [
                                'channel_id'           => 1,
                                'channel_product_code' => 'x',
                                'delete'               => 'false',
                                'success'              => 'true',
                                'synced'               => '2022-02-01',
                            ]
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
                        'channels'  => [
                            [
                                'channel_id'           => 2,
                                'channel_product_code' => 'x',
                                'delete'               => 'false',
                                'success'              => 'true',
                                'synced'               => '2022-02-01',
                            ]
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
        $c = new DTO\SystemProducts($mockData);
        $this->assertSystemProducts($c);
        $c = new DTO\SystemProducts([]);
        $this->assertSystemProductsNull($c);
    }

    private function assertSystemProducts(DTO\SystemProducts $c)
    {
        foreach ($c->system_products as $sp) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $sp);
            $this->assertIsArray($sp->meta);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp->meta[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $sp->meta[0]);
            $this->assertIsArray($sp->options);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp->options[0] );
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $sp->options[0]);
            $this->assertIsArray($sp->images);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp->images[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Image', $sp->images[0]);
            $this->assertIsArray($sp->options);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp->options[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $sp->options[0]);
            $this->assertIsArray($sp->channels);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp->channels[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Channel', $sp->channels[0]);
            $this->assertIsArray($sp->variants);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp->variants[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemVariant', $sp->variants[0]);
        }
    }

    private function assertSystemProductsNull(DTO\SystemProducts $c)
    {
        foreach ($c->system_products as $sp) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $sp);
            $this->assertIsArray($sp->meta);
            $this->assertIsArray($sp->options);
            $this->assertIsArray($sp->images);
            $this->assertIsArray($sp->options);
            $this->assertIsArray($sp->channels);
            $this->assertIsArray($sp->variants);
        }

    }
}
