<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypePriceTier = array{
 *     price?: float|null,
 *     tier?: string|null
 * }
 */
class PriceTier extends DTO
{
    public ?string $tier;
    public ?float $price;

    /**
     * PriceTier constructor.
     * @param TypePriceTier $data
     */
    public function __construct(array $data)
    {
        $this->tier  = self::stringFrom($data, "tier");
        $this->price = self::floatFrom($data, "price");
    }

    public static function createFromJSON(string $json): PriceTier
    {
        $data = json_decode($json, true);
        return new PriceTier($data);
    }



    /**
     * @return PriceTier[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new PriceTier((array)$item);
        }
        return $a;
    }
}
