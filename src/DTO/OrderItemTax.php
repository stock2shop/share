<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class OrderItemTax extends DTO implements JsonSerializable, DTOInterface
{
    public ?float $price;
    public ?string $title;
    public ?float $rate;

    public function __construct(array $data)
    {
        $this->price = self::floatFrom($data, "price");
        $this->title = self::stringFrom($data, "title");
        $this->rate  = self::floatFrom($data, "rate");
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): OrderItemTax
    {
        $data = json_decode($json, true);
        return new OrderItemTax($data);
    }

    /**
     * @return OrderItemTax[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new OrderItemTax((array)$item);
        }
        return $a;
    }
}
