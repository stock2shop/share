<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\User;

class UserTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "customer_id" => null,
            "id" => null,
            "segments" => [[
                "type" => "products",
                "key" => "vendor",
                "operator" => "contains",
                "value" => "Mihoyo",
                "owner" => "system"
            ]],
            "price_tier" => "",
            "qty_availability" => ""
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "customer_id": null,
            "id": null,
            "segments": [{
                "type": "products",
                "key": "vendor",
                "operator": "contains",
                "value": "Mihoyo",
                "owner": "system"
            }],
            "price_tier": "",
            "qty_availability": ""
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new User($this->setUpArray());

        $this->assertSame(null, $object->customer_id);
        $this->assertSame(null, $object->id);
        $this->assertSame("products", $object->segments[0]->type);
        $this->assertSame("vendor", $object->segments[0]->key);
        $this->assertSame("", $object->price_tier);
        $this->assertSame("", $object->qty_availability);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\User", $object);
        $this->assertInstanceOf("Stock2Shop\Share\DTO\Segment", $object->segments[0]);


        $object_attributes = [
            "customer_id",
            "id",
            "price_tier",
            "qty_availability"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void
    { 
        $array = User::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void
    { 
        $json = $this->setUpJson();
        $array = json_encode(User::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "customer_id" => null,
                "id" => null,
                "segments" => [[
                    "type" => "products",
                    "key" => "vendor",
                    "operator" => "contains",
                    "value" => "Mihoyo",
                    "owner" => "system"
                ]],
                "price_tier" => "",
                "qty_availability" => ""
            ],
            [
                "customer_id" => 0,
                "id" => 90,
                "segments" => [[
                    "type" => "products",
                    "key" => "vendor",
                    "operator" => "contains",
                    "value" => "Mihoyo",
                    "owner" => "system"
                ]],
                "price_tier" => "",
                "qty_availability" => ""
            ]
        ];
        $json = json_encode(User::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>