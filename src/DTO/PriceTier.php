<?php

namespace Stock2Shop\Share\DTO;

class PriceTier extends  AbstractBase
{
    /** @var string|null $tier */
    protected $tier;

    /** @var float|null $price */
    protected $price;

    /**
     * PriceTier constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        $this->tier  = self::stringFrom($data, "tier");
        $this->price = self::floatFrom($data, "price");
    }

    public function setPrice($arg) {
        $this->price = self::toFloat($arg);
    }

    public function setTier($arg) {
        $this->tier = self::toString($arg);
    }

    public function getTier() {
        return $this->tier;
    }

    public function getPrice() {
        return $this->price;
    }
}
