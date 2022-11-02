<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class OrderMetaTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "key": "key",
            "value": "value"
        }';
    }

    public function testSerialize(): void
    {
        $m = DTO\OrderMeta::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\OrderMeta::createFromJSON($this->json);
        $this->assertOrderMeta($m);
    }

    private function assertOrderMeta(DTO\OrderMeta $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderMeta', $c);
    }
}
