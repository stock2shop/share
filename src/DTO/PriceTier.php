<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class PriceTier extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $tier;
    public ?float $price;

    /**
     * PriceTier constructor.
     */
    function __construct(array $data)
    {
        $this->tier = self::stringFrom($data, "tier");
        $this->price = self::floatFrom($data, "price");
    }

    static function createFromJSON(string $json): PriceTier
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
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new PriceTier((array)$item);
        }
        return $a;
    }
}
