<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ChannelOrderCustomer;

class ChannelOrderCustomerTest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "accepts_marketing" => "false",
            "email" => "keenan@gmail.com",
            "first_name" => "Keenan",
            "last_name" => "Faure",
            "channel_customer_code" => ""
        ];
        return $array;
    }

    private function setUpJson(): string
    { 
        $json = '
        {
            "accepts_marketing": false,
            "email": "keenan@gmail.com",
            "first_name": "Keenan",
            "last_name": "Faure",
            "channel_customer_code": ""
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new ChannelOrderCustomer($this->setUpArray());

        $this->assertSame(false, $object->accepts_marketing);
        $this->assertSame("keenan@gmail.com", $object->email);
        $this->assertSame("Keenan", $object->first_name);
        $this->assertSame("Faure", $object->last_name);
        $this->assertSame("", $object->channel_customer_code);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelOrderCustomer", $object);

        $object_attributes = [
            "accepts_marketing",
            "email",
            "first_name",
            "last_name",
            "channel_customer_code"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    //public function testSerialize(): void { }

    public function testJsonConversion(): void 
    {
        $json = $this->setUpJson();
        $array = json_encode(ChannelOrderCustomer::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "accepts_marketing" => false,
                "email" => "keenan@gmail.com",
                "first_name" => "Keenan",
                "last_name" => "Faure",
                "channel_customer_code" => ""
            ],
            [
                "accepts_marketing" => false,
                "email" => "ryan@gmail.com",
                "first_name" => "Ryan",
                "last_name" => "",
                "channel_customer_code" => ""
            ]
        ];

        $json = json_encode(ChannelOrderCustomer::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>