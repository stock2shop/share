<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class OrderSourceTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "source_id": 57,
            "source_customer_code": "source_customer_code",
            "source_order_code": "source_order_code"
        }';
    }

    public function testSerialize(): void
    {
        $m = DTO\OrderSource::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\OrderSource::createFromJSON($this->json);
        $this->assertOrderSource($m);
    }

    private function assertOrderSource(DTO\OrderSource $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\OrderSource', $c);
    }
}
