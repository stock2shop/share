<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemProductsTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "system_products": [
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
                },
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
                            "id": 2,
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
                    "id": 2,
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
                            "id": 2,
                            "image_id": 2,
                            "client_id": 2,
                            "product_id": 2,
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
                }
            ]
        }';
    }

    public function testSerialize(): void
    {
        $sp = DTO\SystemProducts::createFromJSON($this->json);
        $serialized = json_encode($sp);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $sp = DTO\SystemProducts::createFromJSON($this->json);
        $this->assertSystemProducts($sp);
    }

    private function assertSystemProducts(DTO\SystemProducts $c)
    {
        foreach ($c->system_products as $sp) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemProduct', $sp);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp->meta[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $sp->meta[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp->options[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $sp->options[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp->images[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Image', $sp->images[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp->options[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $sp->options[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp->channels[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Channel', $sp->channels[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $sp->variants[0]);
            $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemVariant', $sp->variants[0]);
        }
    }
}
