<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemOrderAddressTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "address1": "abc",
            "address2": null,
            "channel_id": 56,
            "city": "jhb",
            "client_id": 21,
            "country_code": "ZA",
            "company": "s2s",
            "country": "sa",
            "created": "created",
            "first_name": "bob",
            "last_name": "jones",
            "modified": "modified",
            "phone": "123456",
            "province": "somewhere",
            "province_code": null,
            "type": "billing",
            "zip": "1234"
        }';
    }

    public function testSerialize(): void
    {
        $m          = DTO\SystemOrderAddress::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\SystemOrderAddress::createFromJSON($this->json);
        $this->assertSystemOrderAddress($m);
    }

    private function assertSystemOrderAddress(DTO\SystemOrderAddress $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Address', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemOrderAddress', $c);
    }
}
