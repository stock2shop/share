<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\SystemOrderItem;

class SystemOrderItemTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "barcode" => null,
            "grams" => null,
            "price" => null,
            "qty" => null,
            "sku" => "sku",
            "title" => null,
            "total_discount" => null,
            "created" => "",
            "fulfillments" => [[
                "grams" => null,
                "qty" => null,
                "sku" => null,
                "fulfilled_qty" => null,
                "created" => "",
                "modified" => null
            ]],
            "modified" => null,
            "product_id" => null,
            "variant_id" => null,
            "source_id" => null,
            "source_variant_code" => null,
            "price_display" => null,
            "total_discount_display" => null,
            "tax_per_unit_display" => null,
            "tax" => null,
            "tax_display" => null,
            "sub_total" => null,
            "tax_per_unit" => null,
            "sub_total_display" => null,
            "total" => null,
            "total_display" => null
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "barcode": null,
            "grams": null,
            "price": null,
            "qty": null,
            "sku": "sku",
            "title": null,
            "total_discount": null,
            "created": "",
            "fulfillments": [{
                "grams": null,
                "qty": null,
                "sku": null,
                "fulfilled_qty": null,
                "created": "",
                "modified": null
            }],
            "modified": null,
            "product_id": null,
            "variant_id": null,
            "source_id": null,
            "source_variant_code": null,
            "price_display": null,
            "total_discount_display": null,
            "tax_per_unit_display": null,
            "tax": null,
            "tax_display": null,
            "sub_total": null,
            "tax_per_unit": null,
            "sub_total_display": null,
            "total": null,
            "total_display": null
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new SystemOrderItem($this->setUpArray());

        $this->assertSame(null, $object->barcode);
        $this->assertSame("", $object->created);
        $this->assertSame(null, $object->modified);
        $this->assertSame(null, $object->product_id);
        $this->assertSame(null, $object->tax);
        $this->assertSame(null, $object->price_display);
        $this->assertSame("sku", $object->sku);
        $this->assertSame(null, $object->qty);
        $this->assertSame(null, $object->price);
        $this->assertSame(null, $object->title);


        $this->assertInstanceOf("Stock2Shop\Share\DTO\SystemOrderItem", $object);

        $object_attributes = [
            "barcode",
            "created",
            "variant_id",
            "source_id",
            "source_variant_code",
            "tax",
            "sub_total_display",
            "total",
            "sku",
            "qty",
            "title",
            "price"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testSerialize(): void
    { 
        $array = SystemOrderItem::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void
    { 
        $json = $this->setUpJson();
        $array = json_encode(SystemOrderItem::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "barcode" => null,
                "grams" => null,
                "price" => null,
                "qty" => null,
                "sku" => "sku",
                "title" => null,
                "total_discount" => null,
                "created" => "",
                "fulfillments" => [[
                    "grams" => null,
                    "qty" => null,
                    "sku" => null,
                    "fulfilled_qty" => null,
                    "created" => "",
                    "modified" => null
                ]],
                "modified" => null,
                "product_id" => null,
                "variant_id" => null,
                "source_id" => null,
                "source_variant_code" => null,
                "price_display" => null,
                "total_discount_display" => null,
                "tax_per_unit_display" => null,
                "tax" => null,
                "tax_display" => null,
                "sub_total" => null,
                "tax_per_unit" => null,
                "sub_total_display" => null,
                "total" => null,
                "total_display" => null
            ],
            [
                "barcode" => null,
                "grams" => null,
                "price" => null,
                "qty" => null,
                "sku" => "sku_1",
                "title" => "",
                "total_discount" => null,
                "created" => "",
                "fulfillments" => [[
                    "grams" => null,
                    "qty" => null,
                    "sku" => null,
                    "fulfilled_qty" => null,
                    "created" => "",
                    "modified" => null
                ]],
                "modified" => "",
                "product_id" => null,
                "variant_id" => null,
                "source_id" => null,
                "source_variant_code" => null,
                "price_display" => null,
                "total_discount_display" => null,
                "tax_per_unit_display" => null,
                "tax" => null,
                "tax_display" => null,
                "sub_total" => null,
                "tax_per_unit" => null,
                "sub_total_display" => null,
                "total" => null,
                "total_display" => null
            ]
        ];
        $json = json_encode(SystemOrderItem::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>