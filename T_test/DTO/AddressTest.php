<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\Address;

class AddressTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
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
        ];
        return $array;
    }
    private function setUpJson(): string
    {
        $json = '{
            "address1": "14 Tracy Close",
            "address2": "",
            "city": "Cape Town",
            "country": "",
            "company": "",
            "country_code": "",
            "first_name": "",
            "last_name": "",
            "phone": "",
            "province": "Western Province",
            "province_code": "",
            "type": "",
            "zip": "7785"
        }';
        return $json;
    }

    public function testClassConstructor(): void
    {
        $array = $this->setUpArray();
        $object = new Address($array);

        $this->assertSame('14 Tracy Close', $object->address1);
        $this->assertSame('', $object->address2);
        $this->assertSame('Cape Town', $object->city);
        $this->assertSame('South Africa', $object->country);
        $this->assertSame('', $object->company);
        $this->assertSame('ZA', $object->country_code);
        $this->assertSame('Keenan', $object->first_name);
        $this->assertSame('', $object->last_name);
        $this->assertSame('', $object->phone);
        $this->assertSame('Western Province', $object->province);
        $this->assertSame('WP', $object->province_code);
        $this->assertSame('', $object->type);
        $this->assertSame('7785', $object->zip);
    }

    public function testObject(): void
    {
        $data = new Address($this->setUpArray());
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Address', $data);

        $object_attributes = 
        [
            "address1",
            "address2",
            "city",
            "country",
            "company",
            "country_code",
            "first_name",
            "last_name",
            "phone",
            "province",
            "province_code",
            "type",
            "zip"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $data);
        }
    }

    public function testJSONConversion(): void
    {
        $json = $this->setUpJson();
        $address = Address::createFromJSON($json);
        $data = json_encode($address);

        $this->assertJsonStringEqualsJsonString($data, $json);
    }

    public function testArrayConversion(): void
    {
        $array = [["address1" => "14 Tracy Close", "address2" => "nothing"]];
        
        $data = json_encode(Address::createArray($array));

        $json = '
        [
            {
                "address1": "14 Tracy Close",
                "address2": "nothing",
                "city": null,
                "country": null,
                "company": null,
                "country_code": null,
                "first_name": null,
                "last_name": null,
                "phone": null,
                "province": null,
                "province_code": null,
                "type": null,
                "zip": null
            }
        ]';

        $td_array = Address::createArray($array);
        $data = json_encode($td_array);
        $this->assertJsonStringEqualsJsonString($data, $json);
    }
    
}

?>