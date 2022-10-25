<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class Order extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $channel_order_code;
    public ?string $notes;
    public ?float $total_discount;

    public function __construct(array $data)
    {
        $this->channel_order_code = self::stringFrom($data, 'channel_order_code');
        $this->notes              = self::stringFrom($data, 'notes');
        $this->total_discount     = self::floatFrom($data, 'total_discount');

    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): Order
    {
        $data = json_decode($json, true);
        return new Order($data);
    }

    /**
     * @return Order[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new Order((array)$item);
        }
        return $a;
    }
}
