<?php

namespace Stock2Shop\Share\DTO;

class PriceTier extends  DTO
{
    protected ?string   $tier;
    protected ?float    $price;

    /**
     * PriceTier constructor.
     */
    function __construct(array $data)
    {
        $this->tier  = self::stringFrom($data, "tier");
        $this->price = self::floatFrom($data, "price");
    }

    public function setPrice($arg): void
    {
        $this->price = self::toFloat($arg);
    }

    public function setTier($arg): void
    {
        $this->tier = self::toString($arg);
    }

    public function getTier(): ?string
    {
        return $this->tier;
    }

    public function getPrice(): ?float
    {
        return $this->price;
    }
}
