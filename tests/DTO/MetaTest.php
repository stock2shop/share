<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class MetaTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'key'           => 'key',
            'value'         => 'value',
            'template_name' => 'template_name'
        ];
        $c = new DTO\Meta($mockData);
        $this->assertMeta($c);
        $c = new DTO\Meta([]);
        $this->assertMetaNull($c);
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
