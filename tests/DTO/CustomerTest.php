<?php

declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class CustomerTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "accepts_marketing": true, 
            "email": "email",
            "first_name": "first_name",
            "last_name": "last_name"
        }';
    }

    public function testSerialize(): void
    {
        $m          = DTO\Customer::createFromJSON($this->json);
        $serialized = json_encode($m);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $m = DTO\Customer::createFromJSON($this->json);
        $this->assertCustomer($m);
    }

    private function assertCustomer(DTO\Customer $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Customer', $c);
    }

    /** @dataProvider computeHashDataProvider */
    public function testComputeHash(array $customer, string $expectedHash)
    {
        $c = new DTO\Customer($customer);
        $this->assertEquals($expectedHash, $c->computeHash());
    }

    private function computeHashDataProvider(): array
    {
        return [
            [
                [
                    'accepts_marketing'     => true,
                    'channel_customer_code' => 'channel_customer_code',
                    'email'                 => 'email',
                    'first_name'            => 'first_name',
                    'last_name'             => 'last_name'
                ],
                '9998295c6bf411ef24408e5445b36a39'
            ],
            [
                [
                    'first_name'            => 'first_name-1',
                    'channel_customer_code' => 'channel_customer_code-1',
                    'accepts_marketing'     => true,
                    'last_name'             => 'last_name-1',
                    'email'                 => 'email-1'
                ],
                '1f538ca0cf4c3a5c0a19db7ba47124b9'
            ],
            [
                [
                    'first_name'            => 'first_name-1',
                    'channel_customer_code' => 'channel_customer_code-1',
                    'accepts_marketing'     => true,
                    'last_name'             => 'last_name-1',
                ],
                'f858d28bc7fb37d60e6a350b5d0fb41d'
            ],
            [
                [
                    'first_name'            => 'first_name-1',
                    'last_name'             => 'last_name-1',
                    'channel_customer_code' => 'channel_customer_code-1',
                    'accepts_marketing'     => true
                ],
                'f858d28bc7fb37d60e6a350b5d0fb41d'
            ],
        ];
    }
}
