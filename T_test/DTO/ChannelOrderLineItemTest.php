<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ChannelOrderLineItem;

class ChannelOrderLineItemTest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "barcode" => "2345",
            "grams" => "0",
            "price" => "",
            "qty" => "4",
            "sku" => "GenImp",
            "title" => "",
            "total_discount" => "",
            "tax_lines" => [
                ["price" => "", "title" => "", "rate" => ""]
            ]
        ];
        return $array;
    }

    private function setUpJson(): string
    { 
        $json = '{
            "barcode": "2345",
            "grams": 0,
            "price": null,
            "qty": 4,
            "sku": "GenImp",
            "title": "",
            "total_discount": null,
            "tax_lines": [
            {
                "price": null,
                "title": "",
                "rate": null
            }]
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    {
        $object = new ChannelOrderLineItem($this->setUpArray());
        $this->assertSame("2345", $object->barcode);
        $this->assertSame(0, $object->grams);
        $this->assertSame(null, $object->price);
        $this->assertSame(4, $object->qty);
        $this->assertSame("GenImp", $object->sku);
        $this->assertSame("", $object->title);
        $this->assertSame(null, $object->total_discount);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelOrderLineItem", $object);

        $object_attributes = [
            "barcode",
            "grams",
            "price",
            "qty",
            "sku",
            "title",
            "total_discount",
            "tax_lines"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    // public function testSerialize(): void { }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(ChannelOrderLineItem::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "barcode" => "2345",
                "grams" => 0,
                "price" => null,
                "qty" => 4,
                "sku" => "GenImp",
                "title" => "",
                "total_discount" => null,
                "tax_lines" => [
                    ["price" => 0, "title" => "", "rate" => 0]
                ]
            ],
            [
                "barcode" => "4563",
                "grams" => 34,
                "price" => 43.2,
                "qty" => 2,
                "sku" => "GenImp",
                "title" => "Product",
                "total_discount" => 0,
                "tax_lines" => [
                    ["price" => 43, "title" => "Tax", "rate" => null]
                ]
            ]
        ];
        $json = json_encode(ChannelOrderLineItem::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>