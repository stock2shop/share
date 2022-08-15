<?php

namespace Stock2Shop\Tests\Share;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            "id"               => "123",
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

        $item = new DTO\Channel($mockData);

        $this->assertInstanceOf('Stock2Shop\Share\DTO\Channel', $item);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\AbstractBase', $item);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $item->meta[0]);
        $this->assertCount(9, (array) $item);
        $this->assertTrue(property_exists($item, 'id'));
        $this->assertTrue(property_exists($item, 'description'));
        $this->assertTrue(property_exists($item, 'client_id'));
        $this->assertTrue(property_exists($item, 'type'));
        $this->assertTrue(property_exists($item, 'sync_token'));
        $this->assertTrue(property_exists($item, 'active'));
        $this->assertTrue(property_exists($item, 'meta'));
        $this->assertTrue(property_exists($item, 'price_tier'));
        $this->assertTrue(property_exists($item, 'qty_availability'));
        $this->assertTrue(is_string($item->description));
        $this->assertTrue(is_string($item->type));
        $this->assertTrue(is_string($item->sync_token));
        $this->assertTrue(is_string($item->price_tier));
        $this->assertTrue(is_string($item->qty_availability));
        $this->assertTrue(is_int($item->id));
        $this->assertTrue(is_int($item->client_id));
        $this->assertTrue(is_bool($item->active));
        $this->assertTrue(is_array($item->meta));
    }
}
