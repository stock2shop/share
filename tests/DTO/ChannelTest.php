<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'id'                => '1',
            'active'            => true,
            'client_id'         => 21,
            'created'           => '2022-09-13 09:13:39',
            'modified'          => '2022-09-13 09:13:39',
            'price_tier'        => 'A',
            'description'       => 'testChannel',
            'qty_availability'  => 'wholesale',
            'sync_token'        => '1',
            'type'              => 'trade',
            "meta"              => [
                [
                    'key'           => 'size',
                    'value'         => '12',
                    'template_name' => 'template_a',
                ]
            ]
        ];
        $c = new DTO\Channel($mockData);
        $this->assertChannel($c);
        $c->setClientID(22);
        $c->setActive('any string is cast to true...');
        $this->assertChannel($c);
        $c = new DTO\Channel([]);
        $this->assertChannelNull($c);
    }

    private function assertChannel(DTO\Channel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertIsInt($c->getID());
        $this->assertIsInt($c->getClientID());
        $this->assertIsBool($c->getActive());
        $this->assertIsString($c->getCreated());
        $this->assertIsString($c->getModified());
        $this->assertIsString($c->getDescription());
        $this->assertIsString($c->getPriceTier());
        $this->assertIsString($c->getQtyAvailability());
        $this->assertIsString($c->getSyncToken());
        $this->assertIsString($c->getType());
        foreach ($c->getMeta() as $meta) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $meta);
            $this->assertIsString($meta->getKey());
            $this->assertIsString($meta->getValue());
            $this->assertIsString($meta->getTemplateName());
        }
        $this->assertTrue($c->getActive());
    }

    private function assertChannelNull(DTO\Channel $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertEmpty($c->getMeta());
    }

}
