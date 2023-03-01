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
            "id": 1,
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
            "hash": "hash",
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

    /** @dataProvider computeHashDataProvider */
    public function testComputeHash(DTO\SystemOrderAddress $input, string $output): void
    {
        $hash = $input->computeHash();

        $this->assertEquals(expected: $output, actual: $hash);
    }

    public function computeHashDataProvider(): array
    {
        return [
            [
                'input'  => new DTO\SystemOrderAddress([]),
                'output' => 'd2d1bd6c18a218d7054d3e057e530005'
            ],
            [
                'input'  => new DTO\SystemOrderAddress(data: [
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
                'input'  => new DTO\SystemOrderAddress(data: [
                    "id"            => 1,
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
                'input'  => new DTO\SystemOrderAddress(data: [
                    "client_id"     => 21,
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
                'input'  => new DTO\SystemOrderAddress(data: [
                    "channel_id"    => 1234,
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
                'input'  => new DTO\SystemOrderAddress(data: [
                    "created"       => "created",
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
                'input'  => new DTO\SystemOrderAddress(data: [
                    "modified"      => "modified",
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
                'input'  => new DTO\SystemOrderAddress(data: [
                    "hash"          => "hash",
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
                'input'  => new DTO\SystemOrderAddress(data: [
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
                'input'  => new DTO\SystemOrderAddress(data: [
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
}
