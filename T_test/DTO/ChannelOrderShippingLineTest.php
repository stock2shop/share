<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\ChannelOrderShippingLine;

class ChannelOrderShippingLineTest extends TestCase
{
    private function setUpArray(): array
    { 
        $array = [
            "price" => "",
            "title" => "",
            "tax_lines" => [
                ["price" => "", "title" => "", "rate" => ""]
            ]
        ];
        return $array;
    }

    private function setUpJson(): string
    { 
        $json = '
        {
            "price": null,
            "title": "",
            "tax_lines":
            [{
                "price": null,
                "title": "",
                "rate": null
            }]
        }';
        return $json;
    }
    
    public function testClassConstructor()
    {
        $object = new ChannelOrderShippingLine($this->setUpArray());
        $this->assertSame(null, $object->price);
        $this->assertSame("", $object->title);
        $this->assertSame(null, $object->tax_lines[0]->price);
        $this->assertSame("", $object->tax_lines[0]->title);
        $this->assertSame(null, $object->tax_lines[0]->rate);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\ChannelOrderShippingLine", $object);

        $object_attributes = [
            "price",
            "title"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }
    //public function testSerialize(): void { }

    public function testJsonConversion(): void 
    { 
        $json = $this->setUpJson();
        $array = json_encode(ChannelOrderShippingLine::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "price" => null,
                "title" => "Test",
                "tax_lines" => [
                    ["price" => null, "title" => "", "rate" => null]
                ]
            ],
            [
                "price" => 23.45,
                "title" => "Woocommerce Tax Line",
                "tax_lines" => [
                    ["price" => 9.1, "title" => "", "rate" => 3.21]
                ]
            ]
        ];
        $json = json_encode(ChannelOrderShippingLine::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }
}

?>