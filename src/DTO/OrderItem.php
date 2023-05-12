<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeOrderItem = array{
 *     barcode?: string|null,
 *     grams?: int|null,
 *     price?: float|null,
 *     qty?: int|null,
 *     sku?: string|null,
 *     title?: string|null,
 *     total_discount?: float|null
 * }
 */
class OrderItem extends DTO
{
    public ?string $barcode;
    public ?int $grams;
    public ?float $price;
    public ?int $qty;
    public ?string $sku;
    public ?string $title;
    public ?float $total_discount;

    /**
     * @param TypeOrderItem $data
     */
    public function __construct(array $data)
    {
        $this->barcode        = self::stringFrom($data, "barcode");
        $this->grams          = self::intFrom($data, "grams");
        $this->price          = self::floatFrom($data, "price");
        $this->qty            = self::intFrom($data, "qty");
        $this->sku            = self::stringFrom($data, "sku");
        $this->title          = self::stringFrom($data, "title");
        $this->total_discount = self::floatFrom($data, "total_discount");
    }



    public static function createFromJSON(string $json): OrderItem
    {
        $data = json_decode($json, true);
        return new OrderItem($data);
    }

    /**
     * @return OrderItem[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new OrderItem((array)$item);
        }
        return $a;
    }
}
