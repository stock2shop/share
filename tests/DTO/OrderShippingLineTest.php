<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class OrderShippingLineTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "price": 19.99,
            "title": "title"
        }';
    }

    public function testSerialize(): void
    {
        $m = DTO\OrderShippingLine::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\OrderShippingLine::createFromJSON($this->json);
        $this->assertOrderShippingLine($m);
    }

    private function assertOrderShippingLine(DTO\OrderShippingLine $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderShippingLine', $c);
    }
}
