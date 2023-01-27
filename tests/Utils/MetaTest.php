<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\Utils;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\Meta;
use Stock2Shop\Share\Utils\Meta as meta_util;

class MetaTest extends TestCase
{
    public function testGetValue(): void
    {
        $array = [
            [
                "key" => "",
                "value" => "",
                "template_name" => ""
            ]
        ];
        $meta = Meta::createArray($array);
        $this->assertSame("", meta_util::getValue($meta, ""));

        $meta = 
        [
            [
                "key" => "tax_rate",
                "value" => "15",
                "template_name" => ""
            ]
        ];
        $meta = Meta::createArray($array);
        $this->assertSame("", meta_util::getValue($meta, ""));

        $meta =
        [
            [
                "Key" => "shipping_tax",
                "value" => 15,
                "template_name" => ""
            ]
        ];
        $meta = Meta::createArray($array);
        $this->assertSame("", meta_util::getValue($meta, ""));
    }

    public function testIsTrue(): void
    {
        $array = [
            [
                "key" => "add_order",
                "value" => "false",
                "template_name" => ""
            ],
            [
                "key" => "add_image",
                "value" => "true",
                "template_name" => ""
            ],
            [
                "key" => "delete_product",
                "value" => "true",
                "template_name" => ""
            ]
        ];

        $meta = Meta::createArray($array);

        $this->assertTrue((meta_util::isTrue($meta, "add_image")) == true);
        $this->assertTrue((meta_util::isTrue($meta, "add_order")) == false);
        $this->assertTrue((meta_util::isTrue($meta, "create_customer")) == false);
    }
}

?>