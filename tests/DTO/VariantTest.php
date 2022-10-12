<?php
declare(strict_types=1);

namespace Stock2Shop\Tests\Share\DTO;

use PHPUnit\Framework\TestCase;
use Stock2Shop\Share\DTO;

class VariantTest extends TestCase
{
    private string $json;

    protected function setUp(): void
    {
        $this->json = '
        {
            "source_variant_code": "source_variant_code",
            "sku": "sku",
            "active": true,
            "qty": 5,
            "qty_availability": [
                {
                    "description": "description",
                    "qty": 2
                }
            ],
            "price": 19.99,
            "price_tiers": [
                {
                    "tier": "wholesale",
                    "price": 20.00
                }
            ],
            "barcode": "barcode",
            "inventory_management": true,
            "grams": 20,
            "option1": "option1",
            "option2": "option2",
            "option3": "option3",
            "meta": [
                {
                    "key": "key",
                    "value": "value",
                    "template_name": "template_name"
                }
            ]
        }';
    }   

    public function testSerialize(): void
    {
        $v = DTO\Variant::createFromJSON($this->json);
        $serialized = json_encode($v);
        $this->assertJsonStringEqualsJsonString($this->json, $serialized);
    }

    public function testInheritance(): void
    {
        $v = DTO\Variant::createFromJSON($this->json);
        $this->assertVariant($v);
        $v = new DTO\Variant([]);
        $this->assertVariantNull($v);
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

    public function testComputeHash()
    {
        $mockData = $this->getTestResourceAsArray(
            'TestVariant_ComputeHash');
        $compareVariant = '032d252ec01f95ba50593893211ef703';

        $v = new DTO\Variant($mockData);
        $this->assertEquals($compareVariant, $v->computeHash());

        $mockData = $this->getTestResourceAsArray(
            'TestVariant_ComputeHash_2');
        $compareVariant = '3a0f52a54fb34c91af5c642486fd897c';

        $v = new DTO\Variant($mockData);
        $this->assertEquals($compareVariant, $v->computeHash());
    }

    /**
     * Returns a test resources' contents as an array.
     */
    private function getTestResourceAsArray(string $fileName): array {
        return json_decode(file_get_contents(
            __DIR__ . '/TestResources/' . $fileName . '.json'), true);
    }

}
