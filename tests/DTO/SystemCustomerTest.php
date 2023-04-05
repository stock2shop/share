<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemCustomerTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "id": 1,
            "accepts_marketing": false,
            "email": "x@y.com",
            "first_name": "bob",
            "last_name": null,
            "active": true,
            "addresses": [
                {
                    "address1": "abc",
                    "address2": null,
                    "address_code": "address_code",
                    "city": "jhb",
                    "client_id": 21,
                    "country_code": "ZA",
                    "company": "s2s",
                    "country": "sa",
                    "created": "created",
                    "default": true,
                    "first_name": "bob",
                    "id": 1,
                    "last_name": "jones",
                    "modified": "modified",
                    "phone": "123456",
                    "province": "somewhere",
                    "province_code": null,
                    "type": "billing",
                    "zip": "1234"
                }
            ],
            "channel_customer_code": "abc",
            "channel_id": null,
            "client_id": 21,
            "created": "2022-01-01",
            "customer_id": 123,
            "meta": [
                {
                  "key": "group",
                  "value": "wholesale",
                  "template_name": "template_a"
                }
            ],
            "modified": "2022-01-01",
            "user": {
                "customer_id": 123,
                "id": 123,
                "segments": [
                    {
                        "type": "products",
                        "key": "collection",
                        "operator": "equal",
                        "value": "abc",
                        "owner": "source"
                    }
                ],
                "price_tier": "a",
                "qty_availability": "b"        
            }
        }';
    }

    public function testSerialize(): void
    {
        $sp         = DTO\SystemCustomer::createFromJSON($this->json);
        $serialized = json_encode($sp);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $sp = DTO\SystemCustomer::createFromJSON($this->json);
        $this->assertSystemCustomer($sp);
    }

    private function assertSystemCustomer(DTO\SystemCustomer $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemCustomer', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->addresses[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Address', $c->addresses[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->meta[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $c->meta[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\User', $c->user);
    }
}
