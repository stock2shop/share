<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class OrderParamsTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "customer_reference": "customer_reference_value",
            "delivery_date": "delivery_date_value",
            "payment_method": "payment_method_value",
            "console_user_id": 123,
            "coupon": ""
        }';
    }

    public function testSerialize(): void
    {
        $ci         = DTO\OrderParams::createFromJSON($this->json);
        $serialized = json_encode($ci);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }
}
