<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ProductOptionTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'name'      => 'name',
            'position'  => 1
        ];
        $c = new DTO\ProductOption($mockData);
        $this->ProductOption($c);
        $c = new DTO\ProductOption([]);
        $this->assertProductOptionNull($c);
    }

    private function ProductOption(DTO\ProductOption $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $c);
    }

    private function assertProductOptionNull(DTO\ProductOption $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ProductOption', $c);
    }

}
