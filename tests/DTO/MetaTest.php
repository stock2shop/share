<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;
use Stock2Shop\Share\Utils\Date;

class MetaTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "key": "src",
            "value": "value",
            "template_name": "template_name"
        }';
    }

    public function testSerialize(): void
    {
        $m = DTO\Meta::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\Meta::createFromJSON($this->json);
        $this->assertMeta($m);
    }

    private function assertMeta(DTO\Meta $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $c);
    }
}
