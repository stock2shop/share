<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-import-type TypeOrderItemTax from OrderItemTax
 * @psalm-type TypeChannelOrderItem = array{
 *     barcode?: string|null,
 *     grams?: int|null,
 *     price?: float|null,
 *     qty?: int|null,
 *     sku?: string|null,
 *     tax_lines?: array<int, TypeOrderItemTax>,
 *     title?: string|null,
 *     total_discount?: float|null
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
