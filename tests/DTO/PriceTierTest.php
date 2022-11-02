<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class PriceTierTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "tier": "wholesale",
            "price": 20.00
        }';
    }

    public function testSerialize(): void
    {
        $pt = DTO\PriceTier::createFromJSON($this->json);
        $serialized = json_encode($pt);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $pt = DTO\PriceTier::createFromJSON($this->json);
        $this->assertPriceTier($pt);
    }

    private function assertPriceTier(DTO\PriceTier $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\PriceTier', $c);
    }
}
