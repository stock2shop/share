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
}
