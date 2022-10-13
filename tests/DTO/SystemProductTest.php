<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemProductTest extends TestCase
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
                    "position": 2
                }
            ],
            "meta": [
                {
                  "key": "size",
                  "value": "12",
                  "template_name": "template_a"
                }
            ],
            "channels": [
                {
                  "id": 1,
                  "active": true,
                  "client_id": 21,
                  "created": "2022-09-13 09:13:39",
                  "modified": "2022-09-13 09:13:39",
                  "price_tier": "A",
                  "description": "testChannel",
                  "qty_availability": "wholesale",
                  "sync_token": "1",
                  "type": "trade",
                  "meta": [
                    {
                      "key": "size",
                      "value": "12",
                      "template_name": "template_a"
                    }
                  ]
                }
            ],
            "client_id": 21,
            "created": "created",
            "hash": "hash",
            "id": 1,
            "images": [
                 {
                    "id": 1,
                    "active": true,
                    "src": "src"
                 }
            ],
            "modified": "modified",
            "source_id": 57,
            "source_product_code": "source_product_code",
            "variants": [
                {
                    "id": 1,
                    "image_id": 1,
                    "client_id": 1,
                    "product_id": 1,
                    "hash": "hash",
                    "source_variant_code": "source_variant_code",
                    "sku": "sku",
                    "active": true,
                    "qty": 5,
                    "qty_availability": [
                        {
                            "description": "description",
                            "qty": 2
                        }
                    ],
                    "price": 19.99,
                    "price_tiers": [
                        {
                            "tier": "wholesale",
                            "price": 20.00
                        }
                    ],
                    "barcode": "barcode",
                    "inventory_management": true,
                    "grams": 20,
                    "option1": "option1",
                    "option2": "option2",
                    "option3": "option3",
                    "meta": [
                        {
                            "key": "key",
                            "value": "value",
                            "template_name": "template_name"
                        }
                    ]
                }
            ]
        }';
    }

    public function testSerialize(): void
    {
        $sp = DTO\SystemProduct::createFromJSON($this->json);
        $serialized = json_encode($sp);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $sp = DTO\SystemProduct::createFromJSON($this->json);
        $this->assertSystemProduct($sp);
        $sp = new DTO\SystemProduct([]);
        $this->assertSystemProductNull($sp);
    }

    private function assertSystemProduct(DTO\SystemProduct $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $c);
        $this->assertIsArray($c->meta);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->meta[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $c->meta[0]);
        $this->assertIsArray($c->options);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->options[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $c->options[0]);
        $this->assertIsArray($c->images);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->images[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Image', $c->images[0]);
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
    private function getTestResourceAsArray(string $fileName): array
    {
        return json_decode(file_get_contents(
            __DIR__ . '/TestResources/' . $fileName . '.json'), true);
    }
}
