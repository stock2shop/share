<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class QtyAvailabilityTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "description": "description",
            "qty": 2
        }';
    }

    public function testSerialize(): void
    {
        $qa = DTO\QtyAvailability::createFromJSON($this->json);
        $serialized = json_encode($qa);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $qa = DTO\QtyAvailability::createFromJSON($this->json);
        $this->assertQtyAvailability($qa);
        $qa = new DTO\QtyAvailability([]);
        $this->assertQtyAvailabilityNull($qa);
    }

    private function assertQtyAvailability(DTO\QtyAvailability $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\QtyAvailability', $c);
    }

    private function assertQtyAvailabilityNull(DTO\QtyAvailability $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\QtyAvailability', $c);
    }
}
