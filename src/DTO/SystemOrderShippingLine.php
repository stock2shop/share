<?php

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeSystemOrderShippingLine = array{
 *     created?: string|null,
 *     id?: int|null,
 *     modified?: string|null,
 *     price?: float|null,
 *     price_display?: string|null,
 *     sub_total?: float|null,
 *     sub_total_display?: string|null,
 *     tax?: float|null,
 *     tax_display?: string|null,
 *     tax_per_unit?: float|null,
 *     tax_per_unit_display?: string|null,
 *     title?: string|null,
 *     total?: float|null,
 *     total_discount?: float|null,
 *     total_discount_display?: string|null,
 *     total_display?: string|null,
 * }
 */
class SystemOrderShippingLine extends OrderShippingLine
{
    public ?string $created;
    public ?string $modified;
    public ?int $id;
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

    /**
     * @param TypeSystemOrderShippingLine $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $this->created                = self::stringFrom($data, "created");
        $this->modified               = self::stringFrom($data, "modified");
        $this->id                     = self::intFrom($data, "id");
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
}
