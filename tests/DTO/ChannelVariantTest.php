<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelVariantTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
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
            "channel_id": 123,
            "channel_variant_code": "channel_variant_code",
            "client_id": 21,
            "delete": false,
            "hash": "hash",
            "id": 1,
            "image_id": 2,
            "product_id": 3,
            "success": true
        }';
    }

    public function testSerialize(): void
    {
        $cv = DTO\ChannelVariant::createFromJSON($this->json);
        $serialized = json_encode($cv);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $cv = DTO\ChannelVariant::createFromJSON($this->json);
        $this->assertChannelVariant($cv);
        $cv = new DTO\ChannelVariant([]);
        $this->assertChannelVariantNull($cv);
    }

    private function assertChannelVariant(DTO\ChannelVariant $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariant', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertEquals(true, $c->success);
        $this->assertEquals(false, $c->delete);
    }

    private function assertChannelVariantNull(DTO\ChannelVariant $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelVariant', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
    }
}
