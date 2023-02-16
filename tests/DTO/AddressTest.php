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

    /** @dataProvider computeHashDataProvider */
    public function testComputeHash(DTO\Address $input, string $output): void
    {
        $hash = $input->computeHash();

        $this->assertEquals(expected: $output, actual: $hash);
    }

    public function computeHashDataProvider(): array
    {
        return [
            [
                'input'  => new DTO\Address([]),
                'output' => 'd2d1bd6c18a218d7054d3e057e530005'
            ],
            [
                'input'  => new DTO\Address(data: [
                    "address1"      => "address1",
                    "address2"      => "address2",
                    "city"          => "city",
                    "country_code"  => "country_code",
                    "company"       => "company",
                    "country"       => "country",
                    "first_name"    => "first_name",
                    "last_name"     => "last_name",
                    "phone"         => "phone",
                    "province"      => "province",
                    "province_code" => "province_code",
                    "type"          => "type",
                    "zip"           => "zip",
                ]),
                'output' => 'dd4c1a19162b2c4d55cd4a3f8555fd6e'
            ],
            [
                'input'  => new DTO\Address(data: [
                    "address1"      => "address1",
                    "address2"      => null,
                    "city"          => "city",
                    "country_code"  => "country_code",
                    "company"       => "company",
                    "country"       => "country",
                    "first_name"    => "first_name",
                    "last_name"     => "last_name",
                    "phone"         => "phone",
                    "province"      => "province",
                    "province_code" => "province_code",
                    "type"          => "type",
                    "zip"           => "zip",
                ]),
                'output' => 'dc468a6fe7f87bb8a1fb09af131d02bf'
            ],
            [
                'input'  => new DTO\Address(data: [
                    "address1"      => "12 Sesame Street",
                    "address2"      => null,
                    "city"          => "Cape Town",
                    "country_code"  => "ZA",
                    "company"       => "Stock2Shop",
                    "country"       => "South Africa",
                    "first_name"    => "John",
                    "last_name"     => "Doe",
                    "phone"         => "076 123 4567",
                    "province"      => "Western Cape",
                    "province_code" => "WC",
                    "type"          => null,
                    "zip"           => 8000,
                ]),
                'output' => '6a51984c4e0f7b102c8d57de0a8b670a'
            ],
        ];
    }

    private function assertAddress(DTO\Address $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Address', $c);
    }
}
