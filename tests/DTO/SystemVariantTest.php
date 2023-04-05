<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemVariantTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "id": 1,
            "image_id": 1,
            "client_id": 1,
            "product_id": 1,
            "hash": "hash",
            "created": "2022-09-13 09:13:39",
            "modified": "2022-09-13 09:13:39",
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
        }';
    }

    public function testSerialize(): void
    {
        $sv = DTO\SystemVariant::createFromJSON($this->json);
        $serialized = json_encode($sv);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $sv = DTO\SystemVariant::createFromJSON($this->json);
        $this->assertSystemVariant($sv);
    }

    private function assertSystemVariant(DTO\SystemVariant $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemVariant', $c);
    }
}
