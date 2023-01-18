<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\Channel;

class ChannelTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "active" => "false",
            "client_id" => "719",
            "created" => "",
            "description" => "",
            "id" => "71",
            "meta" => "[]",
            // "modified" => "",
            "price_tier" => "New_price",
            "qty_availability" => "",
            "sync_token" => "0",
            "type" => "Woocommerce"
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '
        {
            "active":false,
            "client_id":719,
            "created":"",
            "description":"",
            "id":71,
            "meta":[],
            "modified":null,
            "price_tier":"New_price",
            "qty_availability":"",
            "sync_token":"0",
            "type":"Shopify"
        }';
        return $json;
    }

    public function testClassConstructor(): void
    {
        $array = $this->setUpArray();
        $object = new Channel($array);

        $this->assertSame(false, $object->active);
        $this->assertSame(719, $object->client_id);
        $this->assertSame("", $object->created);
        $this->assertSame("", $object->description);
        $this->assertSame(71, $object->id);
        $this->assertSame([], $object->meta);
        $this->assertSame("New_price", $object->price_tier);
        $this->assertSame("", $object->qty_availability);
        $this->assertSame("0", $object->sync_token);
        $this->assertSame("Woocommerce", $object->type);

        $this->testObject($object);
    }

    /** @test */
    public function assertJsonConversion(): void
    {
        $json = $this->setUpJson();

        $object = Channel::createFromJSON($json);
        $data = json_encode($object);
        $this->assertJsonStringEqualsJsonString($json, $data);
    }
    
    public function testArrayConversion(): void
    {
        $array = [
            ["active" => "false","client_id" => "719","created" => "","description" => ""]
        ];
        $data = json_encode(Channel::createArray($array));

        $json = '
        [
            {
                "active":false,
                "client_id":719,
                "created":"",
                "description":"",
                "id": null,
                "meta":[],
                "modified":null,
                "price_tier":null,
                "qty_availability": null,
                "sync_token": null,
                "type": null
            }
        ]';

        $this->assertJsonStringEqualsJsonString($json, $data);
    }
    
    public function testObject(): void
    {
        $data = new Channel($this->setUpArray());

        $this->assertInstanceOf("Stock2Shop\Share\DTO\Channel", $data);
        $object_attributes = 
        [
            "active",
            "client_id",
            "created",
            "description",
            "id",
            "meta",
            "modified",
            "price_tier",
            "qty_availability",
            "sync_token",
            "type"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $data);
        }
    }
}

?>