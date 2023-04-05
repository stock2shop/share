<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelOrderAddressTest extends TestCase
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
            "zip": "1234"
        }';
    }

    public function testSerialize(): void
    {
        $m          = DTO\ChannelOrderAddress::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\ChannelOrderAddress::createFromJSON($this->json);
        $this->assertChannelOrderAddress($m);
    }

    private function assertChannelOrderAddress(DTO\ChannelOrderAddress $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Address', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelOrderAddress', $c);
    }
}
