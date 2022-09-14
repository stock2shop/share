<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class QtyAvailabilityTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'description'   => 'key',
            'qty'           => 99.5,
        ];
        $c = new DTO\QtyAvailability($mockData);
        $this->assertQtyAvailability($c);
        $c = new DTO\QtyAvailability([]);
        $this->assertQtyAvailabilityNull($c);
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
