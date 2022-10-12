<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemImageTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "id": 1,
            "active": true,
            "src": "src"
        }';
    }

    public function testSerialize(): void
    {
        $cic = DTO\SystemImage::createFromJSON($this->json);
        $serialized = json_encode($cic);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $cic = DTO\SystemImage::createFromJSON($this->json);
        $this->assertSystemImage($cic);
        $cic = new DTO\SystemImage([]);
        $this->assertSystemImageNull($cic);
    }

    private function assertSystemImage(DTO\SystemImage $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemImage', $c);
    }

    private function assertSystemImageNull(DTO\SystemImage $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemImage', $c);
    }

}
