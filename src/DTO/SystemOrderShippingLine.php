<?php

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemOrderShippingLine extends OrderShippingLine implements JsonSerializable, DTOInterface
{
    public ?int $channel_id;
    public ?int $client_id;
    public ?string $created;
    public ?string $modified;
    public ?string $price_display;
    public ?float $sub_total;
    public ?string $sub_total_display;
    public ?float $tax;
    public ?string $tax_display;
    public ?float $tax_per_unit;
    public ?string $tax_per_unit_display;
    public ?float $total;
    public ?float $total_discount;
    public ?string $total_discount_display;
    public ?string $total_display;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->channel_id             = self::intFrom($data, "channel_id");
        $this->client_id              = self::intFrom($data, "client_id");
        $this->created                = self::stringFrom($data, "created");
        $this->modified               = self::stringFrom($data, "modified");
        $this->price_display          = self::stringFrom($data, "price_display");
        $this->sub_total              = self::floatFrom($data, "sub_total");
        $this->sub_total_display      = self::stringFrom($data, "sub_total_display");
        $this->tax                    = self::floatFrom($data, "tax");
        $this->tax_display            = self::stringFrom($data, "tax_display");
        $this->tax_per_unit           = self::floatFrom($data, "tax_per_unit");
        $this->tax_per_unit_display   = self::stringFrom($data, "tax_per_unit_display");
        $this->total                  = self::floatFrom($data, "total");
        $this->total_discount         = self::floatFrom($data, "total_discount");
        $this->total_discount_display = self::stringFrom($data, "total_discount_display");
        $this->total_display          = self::stringFrom($data, "total_display");
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): SystemOrderShippingLine
    {
        $data = json_decode($json, true);
        return new SystemOrderShippingLine($data);
    }

    /**
     * @return SystemOrderShippingLine[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemOrderShippingLine((array)$item);
        }
        return $a;
    }
}
