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
        $si = DTO\SystemImage::createFromJSON($this->json);
        $serialized = json_encode($si);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $si = DTO\SystemImage::createFromJSON($this->json);
        $this->assertSystemImage($si);
    }

    private function assertSystemImage(DTO\SystemImage $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemImage', $c);
    }
}
