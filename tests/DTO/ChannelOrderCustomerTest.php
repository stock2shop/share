<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class ChannelOrderCustomerTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "accepts_marketing": true,
            "channel_customer_code": "channel_customer_code", 
            "email": "email",
            "first_name": "first_name",
            "last_name": "last_name"
        }';
    }

    public function testSerialize(): void
    {
        $m = DTO\ChannelOrderCustomer::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\ChannelOrderCustomer::createFromJSON($this->json);
        $this->assertChannelOrderCustomer($m);
    }

    private function assertChannelOrderCustomer(DTO\ChannelOrderCustomer $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\ChannelOrderCustomer', $c);
    }
}
