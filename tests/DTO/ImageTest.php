<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ImageTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "src": "src"
        }';
    }

    public function testSerialize(): void
    {
        $i = DTO\Image::createFromJSON($this->json);
        $serialized = json_encode($i);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $i = DTO\Image::createFromJSON($this->json);
        $this->assertImage($i);
    }


    private function assertImage(DTO\Image $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Image', $c);
    }
}
