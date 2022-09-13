<?php

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemProductTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
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
        ];
        $c        = new DTO\SystemProduct($mockData);
        $this->assertSystemProduct($c);
        $c->setCollection('colletion 2');
        $c->setHash('hash 2');
        $c->setTags('tag 2');
        $this->assertSystemProduct($c);
        $c = new DTO\SystemProduct([]);
        $this->assertSystemProductNull($c);
    }

    private function assertSystemProduct(DTO\SystemProduct $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $c);
        foreach ($c->getMeta() as $meta) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $meta);
            $this->assertIsString($meta->getKey());
            $this->assertIsString($meta->getValue());
            $this->assertIsString($meta->getTemplateName());
        }
        foreach ($c->getOptions() as $option) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $option);
            $this->assertIsString($option->getName());
            $this->assertIsInt($option->getPosition());
        }
        foreach ($c->getImages() as $image) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Image', $image);
            $this->assertIsString($image->getSrc());
        }
        foreach ($c->getChannels() as $channel) {
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
        foreach ($c->getVariants() as $variant) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemVariant', $variant);
        }
        $this->assertIsInt($c->getID());
        $this->assertIsInt($c->getClientID());
        $this->assertIsInt($c->getSourceID());
        $this->assertIsString($c->getSourceProductCode());
        $this->assertIsString($c->getModified());
        $this->assertIsString($c->getCreated());
        $this->assertIsString($c->getHash());
    }

    private function assertSystemProductNull(DTO\SystemProduct $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $c);
        $this->assertEmpty($c->getOptions());
        $this->assertEmpty($c->getMeta());
    }
}
