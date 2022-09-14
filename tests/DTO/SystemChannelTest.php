<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class SystemChannelTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            "id"               => "123",
            'created'          => '2017-08-09T13:22:00:000Z',
            'modified'         => '2017-08-09T13:22:00:000Z',
            "client_id"        => "123",
            "description"      => "test",
            "active"           => "1",
            "type"             => "test",
            "price_tier"       => "test",
            "qty_availability" => "test",
            "sync_token"       => "test",
            "meta"             => [
                [
                    'key'           => 'size',
                    'value'         => '12',
                    'template_name' => 'template_a',
                    'encrypted'     => '1',
                    'created'       => '2017-08-09T13:22:00:000Z',
                ]
            ]
        ];
        $c = new DTO\Channel($mockData);
        $this->assertSystemChannel($c);
        $c = new DTO\Channel([]);
        $this->assertSystemChannelNull($c);
    }

    public function testCreateArray()
    {
        $items    = DTO\Channel::createArray([[], []]);
        $this->assertSystemChannelNull($items[0]);
        $this->assertSystemChannelNull($items[1]);
    }

    private function assertSystemChannel(DTO\Channel $c) {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Channel', $c);
        $this->assertIsArray($c->meta);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->meta[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $c->meta[0]);
    }

    private function assertSystemChannelNull(DTO\Channel $c) {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Channel', $c);
        $this->assertIsArray($c->meta);
    }
}
