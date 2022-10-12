<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

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
        $cic = DTO\Meta::createFromJSON($this->json);
        $serialized = json_encode($cic);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $cic = DTO\Meta::createFromJSON($this->json);
        $this->assertMeta($cic);
        $cic = new DTO\Meta([]);
        $this->assertMetaNull($cic);
    }

    private function assertMeta(DTO\Meta $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $c);
    }

    private function assertMetaNull(DTO\Meta $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $c);
    }

}
