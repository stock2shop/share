<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class PriceTierTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'tier'  => 'wholesale',
            'price' => 19.99
        ];
        $c = new DTO\PriceTier($mockData);
        $this->assertPriceTier($c);
        $c = new DTO\PriceTier([]);
        $this->assertPriceTierNull($c);
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
