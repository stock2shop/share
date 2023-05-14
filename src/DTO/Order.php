<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use Stock2Shop\Share\Utils\Map;

/**
 * @psalm-import-type TypeOrderMeta from OrderMeta
 * @psalm-type TypeOrder = array{
 *     channel_id?: int|null,
 *     channel_order_code?: string|null,
 *     meta?: array<int, TypeOrderMeta>|array<int, OrderMeta>,
 *     notes?: string|null,
 *     ordered_date?: string|null,
 *     total_discount?: float|null
 * }
 */
class Order extends DTO
{
    public ?int $channel_id;
    public ?string $channel_order_code;
    /** @var Map<string, OrderMeta>  */
    public Map $meta;
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
        $this->meta               = new Map(
            OrderMeta::createArray(self::arrayFrom($data, 'meta')),
            'key'
        );
        $this->notes              = self::stringFrom($data, 'notes');
        $this->ordered_date       = self::stringFrom($data, 'ordered_date');
        $this->total_discount     = self::floatFrom($data, 'total_discount');
    }
}
