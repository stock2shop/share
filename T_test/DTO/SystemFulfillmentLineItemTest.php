<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\SystemFulfillmentLineItem;

class SystemFulfillmentLineItemTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "created" => "created_date",
            "modified" => "modified_date",
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
            "created": "created_date",
            "modified": "modified_date",
            "grams": 0,
            "qty": 5,
            "sku": "sku",
            "fulfilled_qty": null
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new SystemFulfillmentLineItem($this->setUpArray());

        $this->assertSame("created_date", $object->created);
        $this->assertSame("modified_date", $object->modified);
        $this->assertSame(0, $object->grams);
        $this->assertSame(5, $object->qty);
        $this->assertSame("sku", $object->sku);
        $this->assertSame(null, $object->fulfilled_qty);


        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemFulfillmentLineItem", $object);

        $object_attributes = [
            "created",
            "modified",
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

    public function testSerialize(): void 
    { 
        $array = SystemFulfillmentLineItem::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(SystemFulfillmentLineItem::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "created" => "created_date",
                "modified" => "modified_date",
                "grams" => 0,
                "qty" => 5,
                "sku" => "sku",
                "fulfilled_qty" => null
            ],
            [
                "created" => "created_date_1",
                "modified" => "modified_date_1",
                "grams" => 0,
                "qty" => 5,
                "sku" => "sku",
                "fulfilled_qty" => null
            ]
        ];
        $json = json_encode(SystemFulfillmentLineItem::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>