<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelProductTest extends TestCase
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
        }';
    }

    public function testSerialize(): void
    {
        $cp = DTO\ChannelProduct::createFromJSON($this->json);
        $serialized = json_encode($cp);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $cp = DTO\ChannelProduct::createFromJSON($this->json);
        $this->assertChannelProduct($cp);
        $cp = new DTO\ChannelProduct([]);
        $this->assertChannelProductNull($cp);
    }

    private function assertChannelProduct(DTO\ChannelProduct $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->channel);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductChannel', $c->channel);
        $this->assertIsArray($c->variants);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->variants[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemVariant', $c->variants[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->variants[0]->channel);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariantChannel', $c->variants[0]->channel);
        $this->assertIsArray($c->images);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->images[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemImage', $c->images[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->images[0]->channel);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelImageChannel', $c->images[0]->channel);
    }

    private function assertChannelProductNull(DTO\ChannelProduct $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->channel);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelProductChannel', $c->channel);
        $this->assertIsArray($c->variants);
        $this->assertIsArray($c->images);
    }
}
