<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\Fulfillment;

class FulfillmentTest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "fulfillmentservice_order_code" => "",
            "notes" => "notes",
            "status" => "",
            "tracking_company" => "",
            "tracking_number" => "5",
            "tracking_url" => ""
        ];
        return $array;
    }

    private function setUpJson(): string
    { 
        $json = '{
            "fulfillmentservice_order_code": "",
            "notes": "notes",
            "status": "",
            "tracking_company": "",
            "tracking_number": 5,
            "tracking_url": "" 
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new Fulfillment($this->setUpArray());

        $this->assertSame("", $object->fulfillmentservice_order_code);
        $this->assertSame("notes", $object->notes);
        $this->assertSame("", $object->status);
        $this->assertSame("", $object->tracking_company);
        $this->assertSame(5, $object->tracking_number);
        $this->assertSame("", $object->tracking_url);


        $this->assertInstanceOf("Stock2Shop\Share\DTO\Fulfillment", $object);

        $object_attributes = [
            "fulfillmentservice_order_code",
            "notes",
            "status",
            "tracking_company",
            "tracking_number",
            "tracking_url"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(Fulfillment::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "fulfillmentservice_order_code" => "",
                "notes" => "notes",
                "status" => "",
                "tracking_company" => "",
                "tracking_number" => 5,
                "tracking_url" => ""
            ],
            [
                "fulfillmentservice_order_code" => "",
                "notes" => "notes",
                "status" => "status",
                "tracking_company" => "tracking",
                "tracking_number" => 10,
                "tracking_url" => "https://"
            ]
        ];

        $json = '[{
            "fulfillmentservice_order_code": "",
            "notes": "notes",
            "status": "",
            "tracking": "",
            "tracking_number": 5,
            "tracking_url": ""
        }, 
        {
            "fulfillmentservice_order_code": "",
            "notes": "notes",
            "status": "status",
            "tracking": "tracking",
            "tracking_number": 10,
            "tracking_url": "https:\/\/"
        }]';

        $json = json_encode(Fulfillment::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>