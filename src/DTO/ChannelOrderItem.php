<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelOrderItem extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $barcode;
    public ?string $sku;
    public ?string $title;
    public ?int $grams;
    public ?int $qty;
    public ?float $price;
    public ?float $total_discount;

    public function __construct(array $data)
    {
        $this->barcode        = self::stringFrom($data, "barcode");
        $this->sku            = self::stringFrom($data, "sku");
        $this->title          = self::stringFrom($data, "title");
        $this->grams          = self::intFrom($data, "grams");
        $this->qty            = self::intFrom($data, "qty");
        $this->price          = self::floatFrom($data, "price");
        $this->total_discount = self::floatFrom($data, "total_discount");

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
