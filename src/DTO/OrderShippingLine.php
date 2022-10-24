<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class OrderShippingLine extends DTO implements JsonSerializable, DTOInterface
{
    public ?float $price;
    public ?string $title;

    public function __construct(array $data)
    {
        $this->price = self::floatFrom($data, 'price');
        $this->title = self::stringFrom($data, 'title');
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): OrderShippingLine
    {
        $data = json_decode($json, true);
        return new OrderShippingLine($data);
    }

    /**
     * @return OrderShippingLine[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new OrderShippingLine((array)$item);
        }
        return $a;
    }
}
