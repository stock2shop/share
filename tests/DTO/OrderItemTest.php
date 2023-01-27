<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\OrderItem;

class OrderItemTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "barcode" => "",
            "grams" => "0",
            "price" => "5",
            "qty" => "",
            "sku" => "sku",
            "title" => "",
            "total_discount" => ""
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "barcode": "",
            "grams": 0,
            "price": 5.0,
            "qty": null,
            "sku": "sku",
            "title": "",
            "total_discount": null
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new OrderItem($this->setUpArray());

        $this->assertSame("", $object->barcode);
        $this->assertSame(0, $object->grams);
        $this->assertSame(5.0, $object->price);
        $this->assertSame(null, $object->qty);
        $this->assertSame("sku", $object->sku);
        $this->assertSame("", $object->title);
        $this->assertSame(null, $object->total_discount);


        $this->assertInstanceOf("Stock2Shop\Share\DTO\OrderItem", $object);

        $object_attributes = [
            "barcode",
            "grams",
            "price",
            "qty",
            "sku",
            "title",
            "total_discount"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(OrderItem::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void
    { 
        $array = [
            [
                "barcode" => "",
                "grams" => 0,
                "price" => 5.0,
                "qty" => null,
                "sku" => "sku",
                "title" => "",
                "total_discount" => null
            ],
            [
                "barcode" => "",
                "grams" => 10,
                "price" => 15.0,
                "qty" => null,
                "sku" => "sku",
                "title" => "",
                "total_discount" => null
            ]
        ];
        $json = json_encode(OrderItem::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>