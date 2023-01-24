<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\DTO;
use Stock2Shop\Share\Utils\Date;

class DTOTest extends TestCase
{
    public function testBoolFrom(): void
    {
        $array = [
            "active" => "true"
        ];
        $this->assertSame(true, DTO::boolFrom($array, "active"));
    }

    public function testStringFrom(): void
    {
        $array = [
            "title" => "product_title"
        ];
        $this->assertSame("product_title", DTO::stringFrom($array, "title"));
    }

    public function testDateStringFrom(): void
    {
        $array = [
            "created" => "2022-11-10 10:21:12.000000"
        ];
        $this->assertSame("2022-11-10 10:21:12.000000", DTO::dateStringFrom($array, "created",Date::FORMAT_MS));
    }

    public function testFloatFrom(): void
    {
        $array = [
            "price" => "5.1"
        ];
        $this->assertSame(5.1, DTO::floatFrom($array, "price"));
    }

    public function testIntFrom(): void
    {
        $array = [
            "qty" => "20"
        ];
        $this->assertSame(20, DTO::intFrom($array, "qty"));
    }

    public function testArrayFrom(): void
    {
        $array = [
            "variants" => [
                "sku" => "sku"
            ]
        ];
        $this->assertSame(["sku" => "sku"], DTO::arrayFrom($array, "variants"));

        $array = [
            "variants" => []
        ];
        $this->assertSame([], DTO::arrayFrom($array, "variants"));

        $array = [
            "variants" => 
            [
                [
                    "sku" => "sku"
                ],
                [
                    "sku" => "sku_1"
                ]
            ]
        ];
        $this->assertSame([["sku" => "sku"],["sku" => "sku_1"]], DTO::arrayFrom($array, "variants"));
    }
}

?>