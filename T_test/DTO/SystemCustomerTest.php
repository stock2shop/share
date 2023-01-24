<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\SystemCustomer;

class SystemCustomerTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "active" => "false",
            "accepts_marketing" => false,
            "email" => "",
            "first_name" => "first_name",
            "last_name" => "last_name",
            "addresses" => [
                [
                    "address1" => "14 Tracy Close",
                    "address2" => "",
                    "city" => "Cape Town",
                    "country" => "South Africa",
                    "company" => "",
                    "country_code" => "ZA",
                    "first_name" => "Keenan",
                    "last_name" => "",
                    "phone" => "",
                    "province" => "Western Province",
                    "province_code" => "WP",
                    "type" => "",
                    "zip" => "7785"
                ]
            ],
            "channel_customer_code" => "",
            "channel_id" => "",
            "client_id" => "",
            "created" => "",
            "customer_id" => "",
            "meta" => [
                [
                    "key" => "key",
                    "value" => "value",
                    "template_name" => ""
                ]
            ],
            "modified" => "",
            "user" => 
            [
                "id" => "",
                "customer_id" => "",
                "segments" => [
                    [
                        "type" => "products",
                        "key" => "vendor",
                        "operator" => "contains",
                        "value" => "Mihoyo",
                        "owner" => "system"
                    ]
                ],
                "price_tier" => "",
                "qty_availability" => ""
            ]
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "active": false,
            "accepts_marketing": false,
            "email": "",
            "first_name": "first_name",
            "last_name":"last_name",
            "addresses": [
                {
                    "address1": "14 Tracy Close",
                    "address2": "",
                    "city": "Cape Town",
                    "country": "South Africa",
                    "company": "",
                    "country_code": "ZA",
                    "first_name": "Keenan",
                    "last_name": "",
                    "phone": "",
                    "province": "Western Province",
                    "province_code": "WP",
                    "type": "",
                    "zip": "7785"
                }
            ],
            "channel_customer_code": "",
            "channel_id": null,
            "client_id": null,
            "created": "",
            "customer_id": null,
            "meta": [
                {
                    "key": "key",
                    "value": "value",
                    "template_name": ""
                }
            ],
            "modified": "",
            "user": 
            {
                "customer_id": null,
                "id": null,
                "segments": [
                    {
                        "type": "products",
                        "key": "vendor",
                        "operator": "contains",
                        "value": "Mihoyo",
                        "owner": "system"
                    }
                ],
                "price_tier": null,
                "qty_availability": null
            }
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new SystemCustomer($this->setUpArray());

        $this->assertSame(false, $object->active);
        $this->assertSame(null, $object->channel_id);
        $this->assertSame(null, $object->client_id);
        $this->assertSame("", $object->created);
        $this->assertSame("", $object->channel_customer_code);
        $this->assertSame("14 Tracy Close", $object->addresses[0]->address1);
        $this->assertSame("7785", $object->addresses[0]->zip);
        $this->assertSame("", $object->modified);
        $this->assertSame("key", $object->meta[0]->key);
        $this->assertSame("value", $object->meta[0]->value);
        $this->assertSame("products", $object->user->segments[0]->type);
        $this->assertSame("vendor", $object->user->segments[0]->key);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemCustomer", $object);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\Address", $object->addresses[0]);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\Meta", $object->meta[0]);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\User", $object->user);


        $object_attributes = 
        [
            "active",
            "client_id",
            "created",
            "modified",
            "channel_id",
            "channel_customer_code"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void 
    { 
        $array = SystemCustomer::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(SystemCustomer::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    {
        $array = [
            [
                "active" => false,
                "accepts_marketing" => false,
                "email" => "",
                "first_name" => "first_name",
                "last_name" => "last_name",
                "addresses" => [
                    [
                        "address1" => "14 Tracy Close",
                        "address2" => "",
                        "city" => "Cape Town",
                        "country" => "South Africa",
                        "company" => "",
                        "country_code" => "ZA",
                        "first_name" => "Keenan",
                        "last_name" => "",
                        "phone" => "",
                        "province" => "Western Province",
                        "province_code" => "WP",
                        "type" => "",
                        "zip" => "7785"
                    ]
                ],
                "channel_customer_code" => "",
                "channel_id" => null,
                "client_id" => null,
                "created" => "",
                "customer_id" => null,
                "meta" => [
                    [
                        "key" => "key",
                        "value" => "value",
                        "template_name" => ""
                    ]
                ],
                "modified" => "",
                "user" => 
                [
                    "customer_id" => null,
                    "id" => null,
                    "segments" => [
                        [
                            "type" => "products",
                            "key" => "vendor",
                            "operator" => "contains",
                            "value" => "Mihoyo",
                            "owner" => "system"
                        ]
                    ],
                    "price_tier" => "",
                    "qty_availability" => ""
                ]
            ],
            [
                "active" => false,
                "accepts_marketing" => false,
                "email" => "",
                "first_name" => "first_name",
                "last_name" => "last_name",
                "addresses" => [
                    [
                        "address1" => "14 Tracy Close",
                        "address2" => "",
                        "city" => "Cape Town",
                        "country" => "South Africa",
                        "company" => "",
                        "country_code" => "ZA",
                        "first_name" => "Keenan",
                        "last_name" => "",
                        "phone" => "",
                        "province" => "Western Province",
                        "province_code" => "WP",
                        "type" => "",
                        "zip" => "7785"
                    ]
                ],
                "channel_customer_code" => "",
                "channel_id" => null,
                "client_id" => null,
                "created" => "",
                "customer_id" => null,
                "meta" => [
                    [
                        "key" => "key",
                        "value" => "value",
                        "template_name" => ""
                    ]
                ],
                "modified" => "",
                "user" => 
                [
                    "customer_id" => null,
                    "id" => null,
                    "segments" => [
                        [
                            "type" => "products",
                            "key" => "vendor",
                            "operator" => "contains",
                            "value" => "Mihoyo",
                            "owner" => "system"
                        ]
                    ],
                    "price_tier" => "",
                    "qty_availability" => ""
                ]
            ]
        ];

        $json = json_encode(SystemCustomer::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

}

?>