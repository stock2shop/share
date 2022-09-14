<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ProductTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'id'            => '1',
            'active'        => true,
            'title'         => 'product',
            'body_html'     => '<div> Content </div>',
            'collection'    => 'collection 1',
            'product_type'  => 'type 1',
            'tags'          => 'tag 1',
            'vendor'        => 'vendor 1',
            'options'       => [
                [
                    'name' => 'name',
                    'position' => 1
                ]
            ],
            'meta'          => [
                [
                    'key' => 'key 1',
                    'value' => 'value 1',
                    'template_name' => 'template_name 1'
                ]
            ],
        ];
        $c = new DTO\Product($mockData);
        $this->assertProduct($c);
        $c = new DTO\Product([]);
        $this->assertProductNull($c);
    }

    private function assertProduct(DTO\Product $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Product', $c);
        $this->assertIsArray($c->meta);
        foreach ($c->meta as $meta) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $meta);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $meta);
        }
        $this->assertIsArray($c->options);
        foreach ($c->options as $option) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $option);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $option);
        }

    }

    private function assertProductNull(DTO\Product $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Product', $c);
        $this->assertIsArray($c->meta);
        $this->assertIsArray($c->options);
    }
}
