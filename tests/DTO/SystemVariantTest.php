<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemVariantTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'id'            => 1,
            'client_id'     => 21,
            'image_id'      => 1,
            'product_id'    => 1,
            'hash'          => 'hash',
        ];
        $c = new DTO\SystemVariant($mockData);
        $this->assertSystemVariant($c);
        $c = new DTO\SystemVariant([]);
        $this->assertSystemVariantNull($c);
    }

    private function assertSystemVariant(DTO\SystemVariant $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemVariant', $c);
    }

    private function assertSystemVariantNull(DTO\SystemVariant $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemVariant', $c);
    }

}
