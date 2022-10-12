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
        $cic = DTO\PriceTier::createFromJSON($this->json);
        $serialized = json_encode($cic);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $cic = DTO\PriceTier::createFromJSON($this->json);
        $this->assertPriceTier($cic);
        $cic = new DTO\PriceTier([]);
        $this->assertPriceTierNull($cic);
    }

    private function assertPriceTier(DTO\PriceTier $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\PriceTier', $c);
    }

    private function assertPriceTierNull(DTO\PriceTier $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\PriceTier', $c);
    }

}
