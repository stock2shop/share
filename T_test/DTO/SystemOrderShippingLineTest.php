<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\SystemOrderShippingLine;

class SystemOrderShippingLineTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "price" => 0.0,
            "title" => "",
            "created" => "",
            "modified" => "",
            "price_display" => "",
            "sub_total" => null,
            "sub_total_display" => null,
            "tax" => null,
            "tax_display" => null,
            "tax_per_unit" => null,
            "tax_per_unit_display" => null,
            "total" => null,
            "total_discount" => null,
            "total_discount_display" => "",
            "total_display" => ""
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "price": 0.0,
            "title": "",
            "created": "",
            "modified": "",
            "price_display": "",
            "sub_total": null,
            "sub_total_display": null,
            "tax": null,
            "tax_display": null,
            "tax_per_unit": null,
            "tax_per_unit_display": null,
            "total": null,
            "total_discount": null,
            "total_discount_display": "",
            "total_display": ""
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new SystemOrderShippingLine($this->setUpArray());

        $this->assertSame("", $object->created);
        $this->assertSame("", $object->modified);
        $this->assertSame("", $object->price_display);
        $this->assertSame(null, $object->sub_total);
        $this->assertSame(null, $object->tax);
        $this->assertSame(null, $object->total_discount);
        $this->assertSame("", $object->total_discount_display);
        $this->assertSame(0.0, $object->price);
        $this->assertSame("", $object->title);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemOrderShippingLine", $object);

        $object_attributes = [
            "created",
            "modified",
            "price_display",
            "sub_total",
            "tax",
            "total_discount",
            "total_discount_display",
            "price",
            "title"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void
    { 
        $array = SystemOrderShippingLine::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void
    { 
        $json = $this->setUpJson();
        $array = json_encode(SystemOrderShippingLine::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    {
        $array = [
            [
                "price" => 10.5,
                "title" => "title",
                "created" => "",
                "modified" => "",
                "price_display" => "",
                "sub_total" => 0,
                "sub_total_display" => null,
                "tax" => null,
                "tax_display" => null,
                "tax_per_unit" => null,
                "tax_per_unit_display" => null,
                "total" => null,
                "total_discount" => null,
                "total_discount_display" => "",
                "total_display" => ""
            ],
            [
                "price" => 90.5,
                "title" => "shipping_title",
                "created" => "",
                "modified" => "",
                "price_display" => "",
                "sub_total" => null,
                "sub_total_display" => null,
                "tax" => null,
                "tax_display" => null,
                "tax_per_unit" => null,
                "tax_per_unit_display" => null,
                "total" => null,
                "total_discount" => null,
                "total_discount_display" => "",
                "total_display" => "total_display"
            ]
        ];
        $json = json_encode(SystemOrderShippingLine::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>