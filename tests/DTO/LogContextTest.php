<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class LogContextTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "key": "foo",
            "value": "bar"
        }';
    }

    public function testSerialize(): void
    {
        $l = DTO\LogContext::createFromJSON($this->json);
        $serialized = json_encode($l);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $l = DTO\LogContext::createFromJSON($this->json);
        $this->assertMeta($l);
        $l = new DTO\LogContext([]);
        $this->assertMetaNull($l);
    }

    private function assertMeta(DTO\LogContext $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\LogContext', $c);
    }

    private function assertMetaNull(DTO\LogContext $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\LogContext', $c);
    }
}
