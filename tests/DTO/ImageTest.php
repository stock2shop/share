<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ImageTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'src' => 'source1'
        ];
        $c = new DTO\Image($mockData);
        $this->assertImage($c);
        $c = new DTO\Image([]);
        $this->assertChannelNull($c);
    }

    private function assertImage(DTO\Image $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Image', $c);
    }

    private function assertChannelNull(DTO\Image $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Image', $c);
    }

}
