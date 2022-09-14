<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class PriceTier extends  DTO
{
    public readonly ?string   $tier;
    public readonly ?float    $price;

    /**
     * PriceTier constructor.
     */
    function __construct(array $data)
    {
        $this->tier  = self::stringFrom($data, "tier");
        $this->price = self::floatFrom($data, "price");
    }
}
