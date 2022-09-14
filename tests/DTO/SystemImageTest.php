<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemImageTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'id' => '1',
            'active' => true,
            'src' => 'source1'
        ];
        $c = new DTO\SystemImage($mockData);
        $this->assertSystemImage($c);
        $c->setSrc('any src will do...');
        $this->assertSystemImage($c);
        $c = new DTO\SystemImage([]);
        $this->assertChannelNull($c);
    }

    private function assertSystemImage(DTO\SystemImage $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemImage', $c);
        $this->assertIsString($c->getSrc());
    }

    private function assertChannelNull(DTO\SystemImage $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemImage', $c);
    }

}
