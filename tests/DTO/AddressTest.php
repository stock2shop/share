<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class AddressTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "address1": "abc",
            "address2": null,
            "city": "jhb",
            "country_code": "ZA",
            "company": "s2s",
            "country": "sa",
            "first_name": "bob",
            "last_name": "jones",
            "phone": "123456",
            "province": "somewhere",
            "province_code": null,
            "type": "billing",
            "zip": "1234"
        }';
    }

    public function testSerialize(): void
    {
        $m          = DTO\Address::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\Address::createFromJSON($this->json);
        $this->assertAddress($m);
    }

    private function assertAddress(DTO\Address $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Address', $c);
    }
}
