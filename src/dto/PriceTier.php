<?php

namespace stock2shop\share\dto;

class PriceTier extends Base
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

    /**
     * @param array $data
     * @return PriceTier[]
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $pmd = new PriceTier((array)$item);
            $a[] = $pmd;
        }
        return $a;
    }
}
