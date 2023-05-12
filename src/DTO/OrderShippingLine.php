<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-import-type TypeOrderItemTax from OrderItemTax
 * @psalm-type TypeOrderShippingLine = array{
 *     price?: float|null,
 *     tax_lines?: array<int, TypeOrderItemTax>|array<int, OrderItemTax>,
 *     title?: string|null
 * }
 */
class OrderShippingLine extends DTO
{
    public ?float $price;
    /** @var OrderItemTax[] $tax_lines */
    public array $tax_lines;
    public ?string $title;

    /**
     * @param TypeOrderShippingLine $data
     */
    public function __construct(array $data)
    {
        $tax_lines = OrderItemTax::createArray(self::arrayFrom($data, 'tax_lines'));

        $this->price     = self::floatFrom($data, 'price');
        $this->tax_lines = $this->sortArray($tax_lines, 'title');
        $this->title     = self::stringFrom($data, 'title');
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
