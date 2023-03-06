<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/** TODO Confirm how to assign types when class extends some other class */
/**
 * @psalm-import-type TypeOrderItemTax from OrderItemTax
 * @psalm-import-type TypeOrderShippingLine from OrderShippingLine
 */
class ChannelOrderShippingLine extends OrderShippingLine implements JsonSerializable, DTOInterface
{
    /** TODO Confirm how to assign types when class extends some other class */
    /**
     * @param OrderItemTax $tax_lines
     * @var OrderItemTax[] $tax_lines
     */
    public array $tax_lines;

    /** TODO Confirm how to assign types when class extends some other class */
    /**
     * @param TypeOrderShippingLine $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);

        $tax_lines = OrderItemTax::createArray(self::arrayFrom($data, 'tax_lines'));

        $this->tax_lines = $this->sortArray($tax_lines, 'title');
    }

    public static function createFromJSON(string $json): ChannelOrderShippingLine
    {
        $data = json_decode($json, true);
        return new ChannelOrderShippingLine($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return ChannelOrderShippingLine[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelOrderShippingLine((array)$item);
        }
        return $a;
    }
}
