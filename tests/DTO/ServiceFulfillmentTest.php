<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ServiceFulfillment;

class ServiceFulfillmentTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "fulfillmentservice_order_code" => "",
            "notes" => "note",
            "status" => "",
            "tracking_company" => "",
            "tracking_number" => "5",
            "tracking_url" => "",
            "line_items" => [
                [
                    "grams" => "0",
                    "qty" => "5",
                    "sku" => "sku",
                    "fulfilled_qty" => ""
                ],
                [
                    "grams" => "0",
                    "qty" => "10",
                    "sku" => "sku_1",
                    "fulfilled_qty" => ""
                ]
            ]
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "fulfillmentservice_order_code": "",
            "notes": "note",
            "status": "",
            "tracking_company": "",
            "tracking_number": 5,
            "tracking_url": "",
            "line_items": [
                {
                    "grams": 0,
                    "qty": 5,
                    "sku": "sku",
                    "fulfilled_qty": null
                },
                {
                    "grams": 0,
                    "qty": 10,
                    "sku": "sku_1",
                    "fulfilled_qty": null
                }
            ]
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new ServiceFulfillment($this->setUpArray());

        $this->assertSame("", $object->fulfillmentservice_order_code);
        $this->assertSame("note", $object->notes);
        $this->assertSame("", $object->status);
        $this->assertSame("", $object->tracking_company);
        $this->assertSame(5, $object->tracking_number);
        $this->assertSame("", $object->tracking_url);
        $this->assertSame(0, $object->line_items[0]->grams);
        $this->assertSame(5, $object->line_items[0]->qty);
        $this->assertSame("sku", $object->line_items[0]->sku);
        $this->assertSame(null, $object->line_items[0]->fulfilled_qty);


        $this->assertInstanceOf("Stock2Shop\Share\DTO\ServiceFulfillment", $object);

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

    public function testSerialize(): void
    { 
        $array = ServiceFulfillment::createArray($this->setUpArray())[0];
        $json = json_encode($array->jsonSerialize());
        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    public function testJsonConversion(): void
    { 
        $json = $this->setUpJson();
        $array = json_encode(ServiceFulfillment::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void
    { 
        $array = [
            [
                "fulfillmentservice_order_code" => "",
                "notes" => "note",
                "status" => "",
                "tracking_company" => "",
                "tracking_number" => 5,
                "tracking_url" => null,
                "line_items" => [
                    [
                        "grams" => 0,
                        "qty" => 5,
                        "sku" => "sku",
                        "fulfilled_qty" => null
                    ],
                    [
                        "grams" => 0,
                        "qty" => 10,
                        "sku" => "sku_1",
                        "fulfilled_qty" => null
                    ]
                ]
            ],
            [
                "fulfillmentservice_order_code" => "",
                "notes" => "note",
                "status" => "",
                "tracking_company" => "",
                "tracking_number" => 5,
                "tracking_url" => "",
                "line_items" => [
                    [
                        "grams" => 0,
                        "qty" => 5,
                        "sku" => "sku",
                        "fulfilled_qty" => null
                    ],
                    [
                        "grams" => 0,
                        "qty" => 10,
                        "sku" => "sku_1",
                        "fulfilled_qty" => null
                    ]
                ]
            ]
        ];
        $json = json_encode(ServiceFulfillment::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
    
}

?>