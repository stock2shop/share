<?php

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ProductTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'id'       => '1',
            'active'   => true,
            'title'    => 'product',
            'body_html' => '<div> Content </div>',
            'collection' => 'collection 1',
            'product_type' => 'type 1',
            'tags' => 'tag 1',
            'vendor' => 'vendor 1',
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
        ];
        $c        = new DTO\Product($mockData);
        $this->assertProduct($c);
        $c->setCollection('colletion 2');
        $c->setProductType('type 2');
        $c->setTags('tag 2');
        $c->setBodyHtml('<div> content 2 </div>');
        $this->assertProduct($c);
        $c = new DTO\Product([]);
        $this->assertProductNull($c);
    }

    private function assertProduct(DTO\Product $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Product', $c);
        foreach ($c->getMeta() as $meta) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $meta);
        }
        foreach ($c->getOptions() as $option) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $option);
        }
        $this->assertIsBool($c->getActive());
        $this->assertIsString($c->getTitle());
        $this->assertIsString($c->getBodyHtml());
        $this->assertIsString($c->getCollection());
        $this->assertIsString($c->getProductType());
        $this->assertIsString($c->getTags());
        $this->assertIsString($c->getVendor());
    }

    private function assertProductNull(DTO\Product $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Product', $c);
        $this->assertEmpty($c->getOptions());
        $this->assertEmpty($c->getMeta());
    }
}
