<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ProductOptionTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "name": "name",
            "position": 2
        }';
    }

    public function testSerialize(): void
    {
        $po = DTO\ProductOption::createFromJSON($this->json);
        $serialized = json_encode($po);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $po = DTO\ProductOption::createFromJSON($this->json);
        $this->assertProductOption($po);
    }

    private function assertProductOption(DTO\ProductOption $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $c);
    }
}
