<?php

namespace Stock2Shop\Tests\Share;

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
                'key'           => 'size',
                'value'         => '12',
                'template_name' => 'template_a',
                'encrypted'     => '1',
                'created'       => '2017-08-09T13:22:00:000Z',
            ]
        ];

        $item = new DTO\SystemChannel($mockData);

        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemChannel', $item);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\AbstractBase', $item);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $item->meta[0]);
        $this->assertCount(11, (array)$item);
        $this->assertObjectHasAttribute('id', $item);
        $this->assertObjectHasAttribute('id', $item);
        $this->assertObjectHasAttribute('created', $item);
        $this->assertObjectHasAttribute('client_id', $item);
        $this->assertObjectHasAttribute('description', $item);
        $this->assertObjectHasAttribute('type', $item);
        $this->assertObjectHasAttribute('sync_token', $item);
        $this->assertObjectHasAttribute('active', $item);
        $this->assertObjectHasAttribute('meta', $item);
        $this->assertObjectHasAttribute('modified', $item);
        $this->assertObjectHasAttribute('price_tier', $item);
        $this->assertObjectHasAttribute('qty_availability', $item);
        $this->assertIsString($item->created);
        $this->assertIsString($item->created);
        $this->assertIsString($item->description);
        $this->assertIsString($item->modified);
        $this->assertIsString($item->price_tier);
        $this->assertIsString($item->qty_availability);
        $this->assertIsString($item->sync_token);
        $this->assertIsString($item->type);
        $this->assertIsInt($item->id);
        $this->assertIsInt($item->client_id);
        $this->assertIsBool($item->active);
        $this->assertIsArray($item->meta);
    }

    public function testCreateArray()
    {
        $mockData = [
            [
                "id" => "123"
            ],
            [
                "id" => "4"
            ]
        ];
        $items    = DTO\SystemChannel::createArray($mockData);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemChannel', $items[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\AbstractBase', $items[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\SystemChannel', $items[1]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\AbstractBase', $items[1]);
    }
}
