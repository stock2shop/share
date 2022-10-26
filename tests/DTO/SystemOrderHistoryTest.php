<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemOrderHistoryTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "instruction": "instruction",
            "storage_code": "storage_code",
            "channel_id": 56,
            "client_id": 21,
            "created": "created",
            "modified": "modified"
        }';
    }

    public function testSerialize(): void
    {
        $m          = DTO\SystemOrderHistory::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\SystemOrderHistory::createFromJSON($this->json);
        $this->assertSystemOrderHistory($m);
    }

    private function assertSystemOrderHistory(DTO\SystemOrderHistory $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemOrderHistory', $c);
    }
}
