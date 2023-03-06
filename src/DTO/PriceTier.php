<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypePriceTier = array{
 *     tier?: string,
 *     price?: float
 * }
 */
class PriceTier extends DTO implements JsonSerializable, DTOInterface
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

    public function jsonSerialize(): array
    {
        return (array)$this;
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
