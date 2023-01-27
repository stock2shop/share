<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;

use PHPUnit\Framework\Constraint\IsFalse;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\SystemProduct;

class SystemProductTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "active" => null,
            "title" => null,
            "body_html" => null,
            "collection" => null,
            "product_type" => null,
            "tags" => null,
            "vendor" => null,
            "options" => [],
            "meta" => [],
            "channels" => [[
                "active" => false,
                "client_id" => 719,
                "created" => "",
                "description" => "",
                "id" => 71,
                "meta" => [],
                "modified" => null,
                "price_tier" => "New_price",
                "qty_availability" => null,
                "sync_token" => "0",
                "type" => "Woocommerce"
            ]],
            "client_id" => null,
            "created" => "",
            "hash" => "",
            "id" => null,
            "images" => [[
                "src" => "",
                "id" => 0,
                "active" => true
            ]],
            "modified" => "",
            "source_id" => null,
            "source_product_code" => "",
            "variants" => [[
                "source_variant_code" => "",
                "sku" => "",
                "active" => false,
                "qty" => null,
                "qty_availability" => [],
                "price" => null,
                "price_tiers" => [],
                "barcode" => null,
                "inventory_management" => null,
                "grams" => null,
                "option1" => null,
                "option2" => null,
                "option3" => null,
                "meta" => [],
                "client_id" => null,
                "hash" => "",
                "id" => null,
                "image_id" => null,
                "product_id" => null
            ]]
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "active": null,
            "title": null,
            "body_html": null,
            "collection": null,
            "product_type": null,
            "tags": null,
            "vendor": null,
            "options": [],
            "meta": [],
            "channels": [{
                "active": false,
                "client_id": 719,
                "created": "",
                "description": "",
                "id": 71,
                "meta": [],
                "modified": null,
                "price_tier": "New_price",
                "qty_availability": null,
                "sync_token": "0",
                "type": "Woocommerce"
            }],
            "client_id": null,
            "created": "",
            "hash": "",
            "id": null,
            "images": [{
                "src": "",
                "id": 0,
                "active": true
            }],
            "modified": "",
            "source_id": null,
            "source_product_code": "",
            "variants": [{
                "source_variant_code": "",
                "sku": "",
                "active": false,
                "qty": null,
                "qty_availability": [],
                "price": null,
                "price_tiers": [],
                "barcode": null,
                "inventory_management": null,
                "grams": null,
                "option1": null,
                "option2": null,
                "option3": null,
                "meta": [],
                "client_id": null,
                "hash": "",
                "id": null,
                "image_id": null,
                "product_id": null
            }]
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new SystemProduct($this->setUpArray());

        $this->assertSame(null, $object->client_id);
        $this->assertSame("", $object->created);
        $this->assertSame("", $object->hash);
        $this->assertSame(null, $object->id);
        $this->assertSame("", $object->modified);
        $this->assertSame(null, $object->source_id);
        $this->assertSame(0, $object->images[0]->id);
        $this->assertSame("", $object->variants[0]->sku);
        $this->assertSame(null, $object->variants[0]->qty);
        $this->assertSame(null, $object->variants[0]->option1);


        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemProduct", $object);

        $object_attributes = [
            "client_id",
            "created",
            "hash",
            "id",
            "modified",
            "source_id",
            "source_product_code"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void
    { 
        $array = SystemProduct::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void
    { 
        $json = $this->setUpJson();
        $array = json_encode(SystemProduct::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "active" => null,
                "title" => null,
                "body_html" => null,
                "collection" => null,
                "product_type" => null,
                "tags" => null,
                "vendor" => null,
                "options" => [],
                "meta" => [],
                "channels" => [[
                    "active" => false,
                    "client_id" => 719,
                    "created" => "",
                    "description" => "",
                    "id" => 71,
                    "meta" => [],
                    "modified" => null,
                    "price_tier" => "New_price",
                    "qty_availability" => null,
                    "sync_token" => "0",
                    "type" => "Woocommerce"
                ]],
                "client_id" => null,
                "created" => "",
                "hash" => "",
                "id" => null,
                "images" => [[
                    "src" => "",
                    "id" => 0,
                    "active" => true
                ]],
                "modified" => "",
                "source_id" => null,
                "source_product_code" => "",
                "variants" => [[
                    "source_variant_code" => "",
                    "sku" => "",
                    "active" => false,
                    "qty" => null,
                    "qty_availability" => [],
                    "price" => null,
                    "price_tiers" => [],
                    "barcode" => null,
                    "inventory_management" => null,
                    "grams" => null,
                    "option1" => null,
                    "option2" => null,
                    "option3" => null,
                    "meta" => [],
                    "client_id" => null,
                    "hash" => "",
                    "id" => null,
                    "image_id" => null,
                    "product_id" => null
                ]]
            ],
            [
                "active" => true,
                "title" => null,
                "body_html" => null,
                "collection" => null,
                "product_type" => null,
                "tags" => null,
                "vendor" => "vendor",
                "options" => [],
                "meta" => [],
                "channels" => [[
                    "active" => false,
                    "client_id" => 719,
                    "created" => "",
                    "description" => "",
                    "id" => 71,
                    "meta" => [],
                    "modified" => null,
                    "price_tier" => "New_price",
                    "qty_availability" => null,
                    "sync_token" => "0",
                    "type" => "Woocommerce"
                ]],
                "client_id" => null,
                "created" => "",
                "hash" => "",
                "id" => null,
                "images" => [[
                    "src" => "",
                    "id" => 0,
                    "active" => true
                ]],
                "modified" => "",
                "source_id" => null,
                "source_product_code" => "",
                "variants" => [[
                    "source_variant_code" => "",
                    "sku" => "",
                    "active" => false,
                    "qty" => 0,
                    "qty_availability" => [],
                    "price" => null,
                    "price_tiers" => [],
                    "barcode" => null,
                    "inventory_management" => null,
                    "grams" => null,
                    "option1" => null,
                    "option2" => null,
                    "option3" => null,
                    "meta" => [],
                    "client_id" => null,
                    "hash" => "",
                    "id" => null,
                    "image_id" => null,
                    "product_id" => null
                ]]
            ]
        ];
        $json = json_encode(SystemProduct::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    /** @dataProvider computeHash */
    public function testComputeHash(array $systemProduct, string $expectedValue): void 
    {
        $system_product = new SystemProduct($systemProduct);
        $this->assertEquals($expectedValue, $system_product->computeHash());
    }

    /** @dataProvider computeHash_null */
    public function testComputeHash_null(array $systemProducts, string $expectedValue): void 
    {
        foreach($systemProducts as $systemProduct)
        {
            $system_product = new SystemProduct($systemProduct);
            $this->assertEquals($expectedValue, $system_product->computeHash());
        }
    }

    private function computeHash(): array 
    { 
        return [
            [
                [
                    "active" => true,
                    "title" => "title",
                    "body_html" => "html",
                    "collection" => "collection",
                    "product_type" => null,
                    "tags" => "",
                    "vendor" => null
                ],
                "d2688c1b65fbd348586a385609e0cd02"
            ],
            [
                [
                    "active" => true,
                    "title" => "title",
                    "body_html" => "html",
                    "collection" => "collection",
                    "product_type" => null,
                    "tags" => "",
                ],
                "d2688c1b65fbd348586a385609e0cd02"
            ],
            [
                [
                    "active" => true,
                    "collection" => "collection",
                    "product_type" => null,
                    "title" => "title",
                    "tags" => "",
                    "body_html" => "html",
                    "vendor" => null
                ],
                "d2688c1b65fbd348586a385609e0cd02"
            ],
            [
                [
                    "active" => false,
                    "title" => "title",
                    "body_html" => "html",
                    "collection" => "collection",
                    "product_type" => "character",
                    "tags" => "",
                    "vendor" => "Mihoyo",
                    "options" => [],
                    "meta" => [],
                    "channels" => [[
                        "active" => false,
                        "client_id" => 719,
                        "created" => "",
                        "description" => "",
                        "id" => 71,
                        "meta" => [],
                        "modified" => null,
                        "price_tier" => "New_price",
                        "qty_availability" => null,
                        "sync_token" => "0",
                        "type" => "Woocommerce"
                    ]],
                    "client_id" => null,
                    "created" => "",
                    "hash" => "",
                    "id" => null,
                    "images" => [[
                        "src" => "",
                        "id" => 0,
                        "active" => true
                    ]],
                    "modified" => "",
                    "source_id" => null,
                    "source_product_code" => "",
                    "variants" => [[
                        "source_variant_code" => "",
                        "sku" => "",
                        "active" => false,
                        "qty" => null,
                        "qty_availability" => [],
                        "price" => null,
                        "price_tiers" => [],
                        "barcode" => null,
                        "inventory_management" => null,
                        "grams" => null,
                        "option1" => null,
                        "option2" => null,
                        "option3" => null,
                        "meta" => [],
                        "client_id" => null,
                        "hash" => "",
                        "id" => null,
                        "image_id" => null,
                        "product_id" => null
                    ]]
                ],
                "1c337ff0e7e1fb5e310fbd0508cbecfc"
            ]
        ];
    }
    
    private function computeHash_null(): array 
    { 
        return [
            [
                [
                    [],
                    [
                        "active" => null,
                        "title" => null,
                        "body_html" => null,
                        "collection" => null,
                        "product_type" => null,
                        "tags" => null,
                        "vendor" => null
                    ]
                ],
                "6f359506713a29ddaf1bc89d88c4ef0c"
            ]
        ];
    }
}

?>