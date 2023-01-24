<?php

declare(strict_types=1);

namespace Stock2Shop\Test\Share\DTO;
use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO\Customer;

class CustomerTest extends TestCase
{
    private function setUpArray(): array
    {
        $array = [
            "accepts_marketing" => "false",
            "email" => "",
            "first_name" => "first_name",
            "last_name" => "last_name"
        ];
        return $array;
    }

    private function setUpJson(): string
    {
        $json = '{
            "accepts_marketing": false,
            "email": "",
            "first_name": "first_name",
            "last_name":"last_name"
        }';
        return $json;
    }
    
    public function testClassConstructor(): void
    { 
        $object = new Customer($this->setUpArray());

        $this->assertSame(false, $object->accepts_marketing);
        $this->assertSame("", $object->email);
        $this->assertSame("first_name", $object->first_name);
        $this->assertSame("last_name", $object->last_name);

        $this->assertInstanceOf("Stock2Shop\Share\DTO\Customer", $object);

        $object_attributes = [
            "accepts_marketing",
            "email",
            "first_name",
            "last_name"
        ];

        for($i = 0; $i < sizeof($object_attributes); ++$i)
        {
            $this->assertObjectHasAttribute($object_attributes[$i], $object);
        }
    }

    public function testJsonConversion(): void 
    {
        $json = $this->setUpJson();
        $array = json_encode(Customer::createFromJSON($json));

        $this->assertJsonStringEqualsJsonString($json, $array);
    }

    public function testArrayConversion(): void 
    { 
        $array = [
            [
                "accepts_marketing" => false,
                "email" => "",
                "first_name" => "first_name",
                "last_name" => "last_name"
            ],
            [
                "accepts_marketing" => true,
                "email" => "",
                "first_name" => "first_name",
                "last_name" => "last_name"
            ]
        ];
        $json = json_encode(Customer::createArray($array));

        $this->assertJsonStringEqualsJsonString(json_encode($array), $json);
    }

    /** @dataProvider computeHash */
    public function testComputeHash(array $customer, string $expectedValue): void 
    { 
        $cust = new Customer($customer);
        $this->assertEquals($expectedValue, $cust->computeHash());
    }

    /** @dataProvider computeHash_null */
    public function testComputeHash_null(array $customers, string $expectedValue): void 
    { 
        foreach($customers as $customer)
        {
            $customer = new Customer($customer);
            $this->assertEquals($expectedValue, $customer->computeHash());
        }
    }

    private function computeHash(): array 
    { 
        return [
            /** First case */
            [
                [
                    "accepts_marketing" => false,
                    "first_name" => null,
                    "last_name" => "last_name"
                ],
                "674be308041afb0d81c0a89f2d74f831",
            ],
            /** Second Case */
            /** Left a property out */
            [
                [
                    "accepts_marketing" => false,
                    "last_name" => "last_name"
                ],
                "674be308041afb0d81c0a89f2d74f831"
            ],
            /** Third Case */
            /** Swaps around properties */
            [
                [
                    "last_name" => "last_name",
                    "accepts_marketing" => false,
                ],
                "674be308041afb0d81c0a89f2d74f831"
            ],
            /** Fourth Test */
            /** All Object properties */
            [
                [
                    "accepts_marketing" => false,
                    "email" => "",
                    "first_name" => "first_name",
                    "last_name" => "last_name"
                ],
                "037d653a08652ab916f62b8ca24d3a79"
            ]
        ];
    }
    private function computeHash_null(): array 
    { 
        return [
            [
                [
                    [],
                    [
                        "accepts_marketing" => null,
                        "email" => null,
                        "first_name" => null,
                        "last_name" => null
                    ]
                ],
                "e08c2826f1230febd06c92a348ad0dfc"
            ]
        ];
    }
    
}

?>