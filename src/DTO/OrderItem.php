<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class OrderItem extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $barcode;
    public ?int $grams;
    public ?float $price;
    public ?int $qty;
    public ?string $sku;
    /** @var OrderItemTax[] $tax_lines */
    public array $tax_lines;
    public ?string $title;
    public ?float $total_discount;

    public function __construct(array $data)
    {
        $tax_lines = OrderItemTax::createArray(self::arrayFrom($data, 'tax_lines'));

        $this->barcode        = self::stringFrom($data, "barcode");
        $this->grams          = self::intFrom($data, "grams");
        $this->price          = self::floatFrom($data, "price");
        $this->qty            = self::intFrom($data, "qty");
        $this->sku            = self::stringFrom($data, "sku");
        $this->tax_lines      = $this->sortArray($tax_lines, 'title');
        $this->title          = self::stringFrom($data, "title");
        $this->total_discount = self::floatFrom($data, "total_discount");

    }

    public function jsonSerialize(): array
    {
        return (array)$this;
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
