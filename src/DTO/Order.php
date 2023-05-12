<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeOrder = array{
 *     channel_id?: int|null,
 *     channel_order_code?: string|null,
 *     notes?: string|null,
 *     ordered_date?: string|null,
 *     total_discount?: float|null
 * }
 */
class Order extends DTO
{
    public ?int $channel_id;
    public ?string $channel_order_code;
    public ?string $notes;
    public ?string $ordered_date;
    public ?float $total_discount;

    /**
     * @param TypeOrder $data
     */
    public function __construct(array $data)
    {
        $this->channel_id         = self::intFrom($data, 'channel_id');
        $this->channel_order_code = self::stringFrom($data, 'channel_order_code');
        $this->notes              = self::stringFrom($data, 'notes');
        $this->ordered_date       = self::stringFrom($data, 'ordered_date');
        $this->total_discount     = self::floatFrom($data, 'total_discount');
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
