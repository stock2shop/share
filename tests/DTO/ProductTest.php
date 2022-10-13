<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ProductTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "active": true,
            "title": "title",
            "body_html": "body_html",
            "collection": "collection",
            "product_type": "product_type",
            "tags": "tags",
            "vendor": "vendor",
            "options": [
                {
                    "name": "name",
                    "position": 1
                }
            ],
            "meta": [
                {
                    "key": "key",
                    "value": "value",
                    "template_name": "template_name"
                }
            ]
        }';
    }

    public function testSerialize(): void
    {
        $p = DTO\Product::createFromJSON($this->json);
        $serialized = json_encode($p);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $p = DTO\Product::createFromJSON($this->json);
        $this->assertProduct($p);
        $p = new DTO\Product([]);
        $this->assertProductNull($p);
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

    public function testComputeHash()
    {
        $mockData = $this->getTestResourceAsArray(
            'TestProduct_ComputeHash'
        );
        $compareProduct = 'fce560b33580b53e33245a762dcefd45';

        $p = new DTO\Product($mockData);
        $this->assertEquals($compareProduct, $p->computeHash());

        $mockData = $this->getTestResourceAsArray(
            'TestProduct_ComputeHash_2'
        );
        $compareProduct = '1f1654769bbb21a34f1647c6680ed813';

        $p = new DTO\Product($mockData);
        $this->assertEquals($compareProduct, $p->computeHash());
    }

    /**
     * Returns a test resources' contents as an array.
     */
    private function getTestResourceAsArray(string $fileName): array
    {
        return json_decode(file_get_contents(
            __DIR__ . '/TestResources/' . $fileName . '.json'
        ), true);
    }
}
