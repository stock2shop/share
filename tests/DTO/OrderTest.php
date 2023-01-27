<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\Order;

class OrderTest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "channel_id" => "5",
            "channel_order_code" => "",
            "notes" => "note",
            "total_discount" => "",
            "state" => "state"
        ];
        return $array;
    }
    private function setUpJson(): string
    { 
        $json = '{
            "channel_id": 5,
            "channel_order_code": "",
            "notes": "note",
            "total_discount": null,
            "state": "state"
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new Order($this->setUpArray());

        $this->assertSame(5, $object->channel_id);
        $this->assertSame("", $object->channel_order_code);
        $this->assertSame("note", $object->notes);
        $this->assertSame(null, $object->total_discount);
        $this->assertSame("state", $object->state);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\Order", $object);

        $object_attributes = [
            "channel_id",
            "channel_order_code",
            "notes",
            "total_discount",
            "state"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testGetState(): void 
    { 
        $order = Order::createFromJson($this->setUpJson());

        $this->assertSame("state", $order->getState());
    }
    public function testSetState(): void 
    { 
        $order = Order::createFromJson($this->setUpJson());
        $order->setState("update");

        $this->assertSame("update", $order->state);
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(Order::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "channel_id" => 5,
                "channel_order_code" => "",
                "notes" => "note",
                "total_discount" => null,
                "state" => "add_order"
            ],
            [
                "channel_id" => 10,
                "channel_order_code" => "",
                "notes" => "notes",
                "total_discount" => null,
                "state" => "sync_order"
            ]
        ];

        $json = '[{
            "channel_id": 5,
            "channel_order_code": "",
            "notes": "note",
            "total_discount": null,
            "state": "add_order"
        }, 
        {
            "channel_id": 10,
            "channel_order_code": "",
            "notes": "notes",
            "total_discount": null,
            "state": "sync_order"
        }]';

        $json = json_encode(Order::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>