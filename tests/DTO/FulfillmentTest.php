<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class FulfillmentTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "fulfillmentservice_order_code": "fulfillmentservice_order_code",
            "notes": "notes",
            "status": "status",
            "tracking_company": "tracking_company",
            "tracking_number": "tracking_number",
            "tracking_url": "tracking_url"
        }';
    }

    public function testSerialize(): void
    {
        $m = DTO\Fulfillment::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\Fulfillment::createFromJSON($this->json);
        $this->assertFulfillment($m);
    }

    private function assertFulfillment(DTO\Fulfillment $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Fulfillment', $c);
    }
}
