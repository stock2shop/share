<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-import-type TypeOrderItemTax from OrderItemTax
 * @psalm-type TypeChannelOrderItem = array{
 *     tax_lines:TypeOrderItemTax,
 *     barcode?: string,
 *     grams?: int,
 *     price?: float,
 *     qty?: int,
 *     sku?: string,
 *     title?: string,
 *     total_discount?: float
 * }
 */
class ChannelOrderItem extends OrderItem implements JsonSerializable, DTOInterface
{
    /** @var OrderItemTax[] $tax_lines */
    public array $tax_lines;

    /**
     * @param TypeChannelOrderItem $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $tax_lines = OrderItemTax::createArray(self::arrayFrom($data, 'tax_lines'));

        $this->tax_lines            = self::sortArray($tax_lines, 'title');
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): ChannelOrderItem
    {
        $data = json_decode($json, true);
        return new ChannelOrderItem($data);
    }

    /**
     * @return ChannelOrderItem[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelOrderItem((array)$item);
        }
        return $a;
    }
}
