<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class VariantTest extends TestCase
{
    public function testConstruct()
    {
        $mockData = [
            'source_variant_code'   => 'source_variant_code',
            'sku'                   => 'sku',
            'active'                => 'true',
            'qty'                   => 2,
            'price'                 => 99.99,
            'barcode'               => 'barcode',
            'inventory_management'  => 'false',
            'grams'                 => 123,
            'option1'               => 'option1',
            'option2'               => 'option2',
            'option3'               => 'option3',
            'meta'                  => [
                [
                    'key' => 'key 1',
                    'value' => 'value 1',
                    'template_name' => 'template_name 1'
                ]
            ],
            'qty_availability'      => [
                [
                    'description' => 'key',
                    'qty' => 99.5,
                ]
            ],
            'price_tiers'           => [
                [
                    'tier' => 'wholesale',
                    'price' => 19.99
                ]
            ]
        ];
        $c = new DTO\Variant($mockData);
        $this->assertVariant($c);
        $c = new DTO\Variant([]);
        $this->assertVariantNull($c);
    }

    private function assertVariant(DTO\Variant $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Variant', $c);
        $this->assertIsArray($c->meta);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->meta[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $c->meta[0]);
        $this->assertIsArray($c->qty_availability);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->qty_availability[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\QtyAvailability', $c->qty_availability[0]);
        $this->assertIsArray($c->price_tiers);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c->price_tiers[0]);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\PriceTier', $c->price_tiers[0]);
    }

    private function assertVariantNull(DTO\Variant $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Variant', $c);
        $this->assertIsArray($c->meta);
        $this->assertIsArray($c->qty_availability);
        $this->assertIsArray($c->price_tiers);
    }

}
