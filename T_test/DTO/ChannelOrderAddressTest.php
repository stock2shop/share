<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ChannelOrderAddress;

class ChannelOrderAddressTest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "address1" => "14 Tracy Close",
            "address2" => "Montrose Park",
            "city" => "Cape Town",
            "country" => "South Africa",
            "company" => "",
            "country_code" => "ZA",
            "first_name" => "Keenan",
            "last_name" => "Faure",
            "phone" => "N/A",
            "province" => "Western Province",
            "province_code" => "WP",
            "type" => ""
        ];
        return $array;
    }

    private function setUpJson(): string
    { 
        $json = '
        {
            "address1": "14 Tracy Close",
            "address2": "Montrose Park",
            "city": "Cape Town",
            "country": "South Africa",
            "company": "",
            "country_code": "",
            "first_name": "Keenan",
            "last_name": "Faure",
            "phone": "N/A",
            "province": "Western Province",
            "province_code": "WP",
            "type": "",
            "zip": "7785"
        }';
        return $json;
    }
    
    //will change with each class
    public function testClassConstructor(): void
    { 
        $object = new ChannelOrderAddress($this->setUpArray());

        $this->assertSame("14 Tracy Close", $object->address1);
        $this->assertSame("Montrose Park", $object->address2);
        $this->assertSame("Western Province", $object->province);
        $this->assertSame("", $object->type);
        $this->assertSame(null, $object->zip);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelOrderAddress", $object);

        $object_attributes = [
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
            "type"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }
    public function testSerialize(): void { }
    public function testJsonConversion(): void { }
    public function testArrayConversion(): void { }
}

?>