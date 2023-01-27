<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\Product;

class ProductTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "active" => "true",
            "title" => "prod_title",
            "body_html" => "",
            "collection" => "",
            "product_type" => "character",
            "tags" => "",
            "vendor" => "",
            "options" => [
                [
                    "name" => "Color",
                    "position" => "2"
                ],
                [
                    "name" => "Size",
                    "position" => "1"
                ]
            ],
            "meta" => [
                [
                    "key" => "key",
                    "value" => "value",
                    "template_name" => ""
                ],
                [
                    "key" => "key_1",
                    "value" => "value_1",
                    "template_name" => ""
                ]
            ]
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "active": true,
            "title": "prod_title",
            "body_html": "",
            "collection": "",
            "product_type": "character",
            "tags": "",
            "vendor": "",
            "options": [
                {
                    "name": "Color",
                    "position": 2
                },
                {
                    "name": "Size",
                    "position": 1
                }
            ],
            "meta": [
                {
                    "key": "key",
                    "value": "value",
                    "template_name": ""
                },
                {
                    "key": "key_1",
                    "value": "value_1",
                    "template_name": ""
                }
            ]
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new Product($this->setUpArray());

        $this->assertSame(true, $object->active);
        $this->assertSame("prod_title", $object->title);
        $this->assertSame("", $object->body_html);
        $this->assertSame("", $object->collection);
        $this->assertSame("character", $object->product_type);
        $this->assertSame("", $object->tags);
        $this->assertSame("", $object->vendor);
        $this->assertSame("Color", $object->options[0]->name);
        $this->assertSame(2, $object->options[0]->position);
        $this->assertSame("key", $object->meta[0]->key);
        $this->assertSame("value", $object->meta[0]->value);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\Product", $object);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\ProductOption", $object->options[0]);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\Meta", $object->meta[0]);


        $object_attributes = [
            "active",
            "title",
            "collection",
            "body_html",
            "product_type",
            "tags",
            "vendor"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void 
    { 
        $array = Product::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(Product::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "active" => true,
                "title" => "prod_title",
                "body_html" => "",
                "collection" => "",
                "product_type" => "character",
                "tags" => "",
                "vendor" => "",
                "options" => [
                    [
                        "name" => "Color",
                        "position" => 2
                    ],
                    [
                        "name" => "Size",
                        "position" => 1
                    ]
                ],
                "meta" => [
                    [
                        "key" => "key",
                        "value" => "value",
                        "template_name" => "",
                    ],
                    [
                        "key" => "key_1",
                        "value" => "value_1",
                        "template_name" => "",
                    ]
                ]
            ],
            [
                "active" => false,
                "title" => "prod_title",
                "body_html" => "",
                "collection" => "",
                "product_type" => "character",
                "tags" => "",
                "vendor" => "",
                "options" => [
                    [
                        "name" => "Color",
                        "position" => 2
                    ],
                    [
                        "name" => "Size",
                        "position" => 1
                    ]
                ],
                "meta" => [
                    [
                        "key" => "key",
                        "value" => "value",
                        "template_name" => "",
                    ],
                    [
                        "key" => "key_1",
                        "value" => "value_1",
                        "template_name" => "",
                    ]
                ]
            ]
        ];
        $json = json_encode(Product::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    /** @dataProvider computeHash */
    public function testComputeHash(array $product, string $expectedValue): void 
    {
        $prod = new Product($product);
        $this->assertEquals($expectedValue, $prod->computeHash());
    }

    /** @dataProvider computeHash_null */
    public function testComputeHash_null(array $products, string $expectedValue): void 
    {
        foreach($products as $product)
        {
            $product = new Product($product);
            $this->assertEquals($expectedValue, $product->computeHash());
        }
    }

    private function computeHash(): array 
    {
        return [
            [
                [
                    "active" => true,
                    "title" => "prod_title",
                    "body_html" => null,
                    "product_type" => "character"
                ],
                "5fefe97c913da38436b6b73428637808"
            ],
            [
                [
                    "active" => true,
                    "title" => "prod_title",
                    "product_type" => "character"
                ],
                "5fefe97c913da38436b6b73428637808"
            ],
            [
                [
                    "product_type" => "character",
                    "title" => "prod_title",
                    "active" => true
                ],
                "5fefe97c913da38436b6b73428637808"
            ],
            [
                [
                    "active" => true,
                    "title" => "prod_title",
                    "body_html" => "",
                    "collection" => "",
                    "product_type" => "character",
                    "tags" => "",
                    "vendor" => "",
                    "options" => [
                        [
                            "name" => "Color",
                            "position" => 2
                        ],
                        [
                            "name" => "Size",
                            "position" => 1
                        ]
                    ],
                    "meta" => [
                        [
                            "key" => "key",
                            "value" => "value",
                            "template_name" => "",
                        ],
                        [
                            "key" => "key_1",
                            "value" => "value_1",
                            "template_name" => "",
                        ]
                    ]
                ],
                "4e3da45a64b5c741d9072d163718904b"
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
                        "product_type" => null
                    ]
                ],
                "561d63f75d7f28398828b5d5aa9119e9"
            ]
        ];
    }
    
}

?>