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
        $cic = DTO\QtyAvailability::createFromJSON($this->json);
        $serialized = json_encode($cic);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $cic = DTO\QtyAvailability::createFromJSON($this->json);
        $this->assertQtyAvailability($cic);
        $cic = new DTO\QtyAvailability([]);
        $this->assertQtyAvailabilityNull($cic);
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
