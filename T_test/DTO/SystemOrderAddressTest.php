<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\SystemOrderAddress;

class SystemOrderAddressTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "address1" => "14 Tracy Close",
            "address2" => "",
            "city" => "Cape Town",
            "company" => "",
            "country" => "South Africa",
            "country_code" => "ZA",
            "first_name" => "Keenan",
            "last_name" => "",
            "phone" => "",
            "province" => "Western Province",
            "province_code" => "WP",
            "type" => "",
            "zip" => "7785",
            "channel_id" => null,
            "client_id" => null,
            "created" => "",
            "modified" => ""
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
			"address1": "14 Tracy Close",
			"address2": "",
			"city": "Cape Town",
			"company": "",
			"country": "South Africa",
			"country_code": "ZA",
			"first_name": "Keenan",
			"last_name": "",
			"phone": "",
			"province": "Western Province",
			"province_code": "WP",
			"type": "",
			"zip": "7785",
			"channel_id": null,
			"client_id": null,
			"created": "",
			"modified": ""
		}';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new SystemOrderAddress($this->setUpArray());

        $this->assertSame(null, $object->channel_id);
        $this->assertSame(null, $object->client_id);
        $this->assertSame("", $object->created);
        $this->assertSame("", $object->modified);
        $this->assertSame("14 Tracy Close", $object->address1);
        $this->assertSame("Cape Town", $object->city);
        $this->assertSame("", $object->company);
        $this->assertSame("South Africa", $object->country);
        $this->assertSame("", $object->phone);
        $this->assertSame("7785", $object->zip);
        $this->assertSame("WP", $object->province_code);
        $this->assertSame("ZA", $object->country_code);


        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemOrderAddress", $object);

        $object_attributes = [
            "channel_id",
            "client_id",
            "modified",
            "created",
            "city",
            "company",
            "province",
            "type",
            "zip",
            "first_name",
            "last_name",
            "phone",
            "country"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void
    { 
        $array = SystemOrderAddress::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void
    { 
        $json = $this->setUpJson();
        $array = json_encode(SystemOrderAddress::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "address1" => "14 Tracy Close",
                "address2" => "",
                "city" => "Cape Town",
                "company" => "",
                "country" => "South Africa",
                "country_code" => "ZA",
                "first_name" => "Keenan",
                "last_name" => "",
                "phone" => "",
                "province" => "Western Province",
                "province_code" => "WP",
                "type" => "",
                "zip" => "7785",
                "channel_id" => null,
                "client_id" => null,
                "created" => "",
                "modified" => ""
            ],
            [
                "address1" => "14 Tracy Close",
                "address2" => "",
                "city" => "Cape Town",
                "company" => "",
                "country" => "South Africa",
                "country_code" => "ZA",
                "first_name" => "Keenan",
                "last_name" => "",
                "phone" => "",
                "province" => "Western Province",
                "province_code" => "WP",
                "type" => "",
                "zip" => "7785",
                "channel_id" => null,
                "client_id" => null,
                "created" => "",
                "modified" => ""
            ]
        ];
        $json = json_encode(SystemOrderAddress::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>