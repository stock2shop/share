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
                    "channels": [],
                    "client_id": 21,
                    "created": "2022-02-03",
                    "hash": "hash",
                    "id": 1,
                    "images": [
                        {
                            "src": "source1",
                            "id": 1,
                            "active": true,
                            "channel": {
                                "channel_id": 123,
                                "channel_image_code": "image_code_abc",
                                "delete": false,
                                "success": true
                            }
                        }
                    ],
                    "modified": "2022-02-03",
                    "source_id": 57,
                    "source_product_code": "source_product_code",
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
                            "client_id": 21,
                            "hash": "hash",
                            "id": 1,
                            "image_id": 2,
                            "product_id": 3,
                            "channel": {
                                "channel_id": 1,
                                "channel_variant_code": "channel_variant_code",
                                "delete": false,
                                "success": true
                            }
                        }
                    ],
                    "channel": {
                        "channel_id": 56,
                        "channel_product_code": "channel_product_code",
                        "delete": false,
                        "success": true,
                        "synced": "2022-02-03"
                    }
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
                    "channels": [],
                    "client_id": 21,
                    "created": "2022-02-04",
                    "hash": "hash",
                    "id": 2,
                    "images": [
                        {
                            "src": "source1",
                            "id": 2,
                            "active": true,
                            "channel": {
                                "channel_id": 234,
                                "channel_image_code": "image_code_abc",
                                "delete": false,
                                "success": true
                            }
                        }
                    ],
                    "modified": "2022-02-04",
                    "source_id": 57,
                    "source_product_code": "source_product_code",
                    "variants": [
                        {
                            "source_variant_code": "source_variant_code",
                            "sku": "sku",
                            "active": true,
                            "qty": 12,
                            "qty_availability": [],
                            "price": 80,
                            "price_tiers": [],
                            "barcode": "barcode",
                            "inventory_management": true,
                            "grams": 145,
                            "option1": "option1",
                            "option2": "option2",
                            "option3": "option3",
                            "meta": [],
                            "client_id": 21,
                            "hash": "hash",
                            "id": 2,
                            "image_id": 3,
                            "product_id": 4,
                            "channel": {
                                "channel_id": 2,
                                "channel_variant_code": "channel_variant_code",
                                "delete": false,
                                "success": true
                            }
                        }
                    ],
                    "channel": {
                        "channel_id": 56,
                        "channel_product_code": "channel_product_code",
                        "delete": false,
                        "success": true,
                        "synced": "2022-02-04"
                    }
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
        $c = DTO\ChannelProducts::createFromJSON($this->json);
        $this->assertChannelProducts($c);
        $c = new DTO\ChannelProducts([]);
        $this->assertChannelProductsNull($c);
    }
    private function assertChannelProducts(DTO\ChannelProducts $c)
    {
        $channelProducts = $c->channel_products;
        foreach ($channelProducts as $cp) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $cp);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->channel);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductChannel', $cp->channel);
            $this->assertIsArray($cp->variants);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->variants[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemVariant', $cp->variants[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->variants[0]->channel);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $cp->variants[0]->channel);
            $this->assertIsArray($cp->images);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->images[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemImage', $cp->images[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->images[0]->channel);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $cp->images[0]->channel);
        }
    }

    private function assertChannelProductsNull(DTO\ChannelProducts $c)
    {
        $channelProducts = $c->channel_products;
        foreach ($channelProducts as $cp) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $cp);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $cp->channel);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductChannel', $cp->channel);
            $this->assertIsArray($cp->variants);
            $this->assertIsArray($cp->images);
        }

    }
}
