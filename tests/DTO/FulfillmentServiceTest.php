<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class FulfillmentServiceTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "id": 1,
            "created": "1970-01-01 00:00:00",
            "description": "description-1",
            "type": "parcelninja",
            "active": true,
            "modified": "1970-01-01 00:00:00",
            "client_id": 21,
            "is_warehouse": false,
            "meta": [
              {
                "key": "key-1",
                "value": "value-1",
                "template_name": null
              }
            ]
        }';
    }

    public function testSerialize(): void
    {
        $m = DTO\FulfillmentService::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\FulfillmentService::createFromJSON($this->json);
        $this->assertServiceFulfillment($m);
    }

    private function assertServiceFulfillment(DTO\FulfillmentService $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\FulfillmentService', $c);
    }
}
