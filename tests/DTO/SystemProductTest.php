<?php
declare(strict_types=1);

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
        ];
        $c = new DTO\SystemProduct($mockData);
        $this->assertSystemProduct($c);
        $c = new DTO\SystemProduct([]);
        $this->assertSystemProductNull($c);
    }

    private function assertSystemProduct(DTO\SystemProduct $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $c);
        $this->assertIsArray($c->meta);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->meta[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $c->meta[0]);
        $this->assertIsArray($c->options);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->options[0] );
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $c->options[0] );
        $this->assertIsArray($c->images);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->images[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Image', $c->images[0]);
        $this->assertIsArray($c->options);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->options[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $c->options[0]);
        $this->assertIsArray($c->channels);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->channels[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Channel', $c->channels[0]);
        $this->assertIsArray($c->variants);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->variants[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemVariant', $c->variants[0]);
    }

    private function assertSystemProductNull(DTO\SystemProduct $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $c);
        $this->assertIsArray($c->meta);
        $this->assertIsArray($c->options);
        $this->assertIsArray($c->images);
        $this->assertIsArray($c->options);
        $this->assertIsArray($c->channels);
        $this->assertIsArray($c->variants);
    }

    public function testComputeHash()
    {
        $mockData = $this->getTestResourceAsArray(
            'TestSystemProduct_ComputeHash');
        $compareProduct = 'e92d087545328d417f99424371dc370f';
        $compareVariant = "75f83570725732c2459af21edeb6a98e";

        $sp = new DTO\SystemProduct($mockData);
        $this->assertEquals($compareProduct, $sp->computeHash());
        $this->assertEquals($compareVariant, $sp->variants[0]->computeHash());

        $mockData = $this->getTestResourceAsArray(
            'TestSystemProduct_ComputeHash_2');
        $compareProduct = '4a35e34194e949f97048b71255180e6d';
        $compareVariant = "e3308f848ff13ea98d47b0024dced387";

        $sp = new DTO\SystemProduct($mockData);
        $this->assertEquals($compareProduct, $sp->computeHash());
        $this->assertEquals($compareVariant, $sp->variants[0]->computeHash());
    }

    /**
     * Returns a test resources' contents as an array.
     */
    private function getTestResourceAsArray(string $fileName): array {
        return json_decode(file_get_contents(
            __DIR__ . '/TestResources/' . $fileName . '.json'), true);
    }
}
