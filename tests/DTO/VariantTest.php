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
            'source_variant_code' => 'source_variant_code',
            'sku' => 'sku',
            'active' => 'true',
            'qty' => 2,
            'price' => 99.99,
            'barcode' => 'barcode',
            'inventory_management' => 'false',
            'grams' => 123,
            'option1' => 'option1',
            'option2' => 'option2',
            'option3' => 'option3',
            'meta' => [
                [
                    'key' => 'key 1',
                    'value' => 'value 1',
                    'template_name' => 'template_name 1'
                ]
            ],
            'qty_availability' => [
                [
                    'description' => 'key',
                    'qty' => 99.5,
                ]
            ],
            'price_tiers' => [
                [
                    'tier' => 'wholesale',
                    'price' => 19.99
                ]
            ]
        ];
        $c = new DTO\Variant($mockData);
        $this->assertVariant($c);
        $c = new DTO\Variant([]);
        $this->assertChannelNull($c);
    }

    private function assertVariant(DTO\Variant $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Variant', $c);
        $this->assertIsString($c->getSourceVariantCode());
        $this->assertIsString($c->getSKU());
        $this->assertIsString($c->getBarcode());
        $this->assertIsString($c->getOption1());
        $this->assertIsString($c->getOption2());
        $this->assertIsString($c->getOption3());
        $this->assertIsInt($c->getQty());
        $this->assertIsInt($c->getGrams());
        $this->assertIsFloat($c->getPrice());
        foreach ($c->getMeta() as $meta) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\Meta', $meta);
            $this->assertIsString($meta->getKey());
            $this->assertIsString($meta->getValue());
            $this->assertIsString($meta->getTemplateName());
        }
        foreach ($c->getQtyAvailability() as $qty) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\QtyAvailability', $qty);
            $this->assertIsString($qty->getDescription());
            $this->assertIsFloat($qty->getQty());
        }
        foreach ($c->getPriceTiers() as $pt) {
            $this->assertInstanceOf('Stock2Shop\Share\DTO\PriceTier', $pt);
            $this->assertIsString($pt->getTier());
            $this->assertIsFloat($pt->getPrice());
        }
    }

    private function assertChannelNull(DTO\Variant $c)
    {
        $this->assertInstanceOf('Stock2Shop\Share\DTO\DTO', $c);
        $this->assertInstanceOf('Stock2Shop\Share\DTO\Variant', $c);
    }

}
