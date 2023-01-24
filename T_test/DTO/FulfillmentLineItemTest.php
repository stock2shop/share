<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\FulfillmentLineItem;

class FulfillmentLineItemTest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "grams" => "0",
            "qty" => "5",
            "sku" => "sku",
            "fulfilled_qty" => ""
        ];
        return $array;
    }

    private function setUpJson(): string
    { 
        $json = '{
            "grams": 0,
            "qty": 5,
            "sku": "sku",
            "fulfilled_qty": null
        }';
        return $json;
    }

    public function testClassConstructor(): void
    { 
        $object = new FulfillmentLineItem($this->setUpArray());

        $this->assertSame(0, $object->grams);
        $this->assertSame(5, $object->qty);
        $this->assertSame("sku", $object->sku);
        $this->assertSame(null, $object->fulfilled_qty);


        $this->assertInstanceOf("Stock2Shop\Share\DTO\FulfillmentLineItem", $object);

        $object_attributes = [
            "grams",
            "qty",
            "sku",
            "fulfilled_qty"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }
    
    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(FulfillmentLineItem::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "grams" => 0,
                "qty" => 5,
                "sku" => "sku",
                "fulfilled_qty" => null
            ],
            [
                "grams" => 20,
                "qty" => 10,
                "sku" => "sku_1",
                "fulfilled_qty" => null
            ]
        ];

        $json = json_encode(FulfillmentLineItem::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>