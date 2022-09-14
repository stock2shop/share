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
        $c->setActive(0);
        $c->setClientID('1');
        $c->setCreated('');
        $c->setDescription('a');
        $c->setID(0);
        $c->setMeta([['key'=> 'a']]);
        $c->setModified('a');
        $c->setPriceTier('a');
        $c->setQtyAvailability('a');
        $c->setSyncToken('a');
        $c->setType('a');
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
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Channel', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $c->getMeta()[0]);
        $this->assertIsBool($c->getActive());
        $this->assertIsInt($c->getClientID());
        $this->assertIsString($c->getCreated());
        $this->assertIsString($c->getDescription());
        $this->assertIsInt($c->getID());
        $this->assertIsArray($c->getMeta());
        $this->assertIsString($c->getMeta()[0]->getKey());
        $this->assertIsString($c->getModified());
        $this->assertIsString($c->getPriceTier());
        $this->assertIsString($c->getQtyAvailability());
        $this->assertIsString($c->getSyncToken());
        $this->assertIsString($c->getType());
    }

    private function assertSystemChannelNull(DTO\Channel $c) {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Channel', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertNull($c->getActive());
        $this->assertNull($c->getClientID());
        $this->assertNull($c->getCreated());
        $this->assertNull($c->getDescription());
        $this->assertNull($c->getID());
        $this->assertIsArray($c->getMeta());
        $this->assertEmpty($c->getMeta());
        $this->assertNull($c->getModified());
        $this->assertNull($c->getPriceTier());
        $this->assertNull($c->getQtyAvailability());
        $this->assertNull($c->getSyncToken());
        $this->assertNull($c->getType());
    }
}
