<?php

namespace Stock2Shop\Share\DTO;

class PriceTier extends  AbstractBase
{
    /** @var string|null $tier */
    public $tier;

    /** @var float|null $price */
    public $price;

    /**
     * PriceTier constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        $this->tier  = self::stringFrom($data, "tier");
        $this->price = self::floatFrom($data, "price");
    }
}
