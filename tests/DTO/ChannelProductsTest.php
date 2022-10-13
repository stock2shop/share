<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelProductsTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "channel_products": [
                {
                    "active": true,
                    "title": "title",
                    "body_html": "body_html",
                    "collection": "collection",
                    "product_type": "product_type",
                    "tags": "tags",
                    "vendor": "vendor",
                    "options": [],
                    "meta": [],
                    "channel_id": 123,
                    "channel_product_code": "channel_product_code",
                    "client_id": 21,
                    "created": "created",
                    "delete": false,
                    "hash": "hash",
                    "id": 1,
                    "images": [
                        {
                            "src": "src",
                            "active": true,
                            "channel_id": 57,
                            "channel_image_code": "channel_image_code",
                            "delete": false,
                            "id": 1,
                            "success": true
                        }
                    ],
                    "modified": "modified",
                    "source_id": 57,
                    "source_product_code": "source_product_code",
                    "success": true,
                    "synced": "synced",
                    "variants": [
                        {
                            "source_variant_code": "source_variant_code",
                            "sku": "sku",
                            "active": true,
                            "qty": 45,
                            "qty_availability": [],
                            "price": 19.99,
                            "price_tiers": [],
                            "barcode": "barcode",
                            "inventory_management": true,
                            "grams": 2,
                            "option1": "option1",
                            "option2": "option2",
                            "option3": "option3",
                            "meta": [],
                            "channel_id": null,
                            "channel_variant_code": null,
                            "client_id": 21,
                            "delete": null,
                            "hash": "hash",
                            "id": 1,
                            "image_id": 2,
                            "product_id": 3,
                            "success": null
                        }
                    ]
                },
                {
                    "active": true,
                    "title": "title",
                    "body_html": "body_html",
                    "collection": "collection",
                    "product_type": "product_type",
                    "tags": "tags",
                    "vendor": "vendor",
                    "options": [],
                    "meta": [],
                    "channel_id": 123,
                    "channel_product_code": "channel_product_code",
                    "client_id": 21,
                    "created": "created",
                    "delete": false,
                    "hash": "hash",
                    "id": 1,
                    "images": [
                        {
                            "src": "src",
                            "active": true,
                            "channel_id": 57,
                            "channel_image_code": "channel_image_code",
                            "delete": false,
                            "id": 1,
                            "success": true
                        }
                    ],
                    "modified": "modified",
                    "source_id": 57,
                    "source_product_code": "source_product_code",
                    "success": true,
                    "synced": "synced",
                    "variants": [
                        {
                            "source_variant_code": "source_variant_code",
                            "sku": "sku",
                            "active": true,
                            "qty": 45,
                            "qty_availability": [],
                            "price": 19.99,
                            "price_tiers": [],
                            "barcode": "barcode",
                            "inventory_management": true,
                            "grams": 2,
                            "option1": "option1",
                            "option2": "option2",
                            "option3": "option3",
                            "meta": [],
                            "channel_id": null,
                            "channel_variant_code": null,
                            "client_id": 21,
                            "delete": null,
                            "hash": "hash",
                            "id": 1,
                            "image_id": 2,
                            "product_id": 3,
                            "success": null
                        }
                    ]
                }
            ]
        }';
    }

    public function testSerialize(): void
    {
        $cp = DTO\ChannelProducts::createFromJSON($this->json);
        $serialized = json_encode($cp);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $cp = DTO\ChannelProducts::createFromJSON($this->json);
        $this->assertChannelProducts($cp);
        $cp = new DTO\ChannelProducts([]);
        $this->assertChannelProductsNull($cp);
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
