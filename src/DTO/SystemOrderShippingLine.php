<?php

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-import-type TypeOrderItemTax from OrderItemTax
 * @psalm-type TypeSystemOrderShippingLine = array{
 *     created?: string,
 *     modified?: string,
 *     id?: int,
 *     price_display?: string,
 *     sub_total?: float,
 *     sub_total_display?: string,
 *     tax?: float,
 *     tax_lines: TypeOrderItemTax,
 *     tax_display?: string,
 *     tax_per_unit?: float,
 *     tax_per_unit_display?: string,
 *     total?: float,
 *     total_discount?: float,
 *     total_discount_display?: string,
 *     total_display?: string,
 *     price?: float,
 *     title?: string
 * }
 */
class SystemOrderShippingLine extends OrderShippingLine implements JsonSerializable, DTOInterface
{
    public ?string $created;
    public ?string $modified;
    public ?int $id;
    public ?string $price_display;
    public ?float $sub_total;
    public ?string $sub_total_display;
    public ?float $tax;
    /** @var OrderItemTax[] $tax_lines */
    public array $tax_lines;
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

        $tax_lines = OrderItemTax::createArray(self::arrayFrom($data, 'tax_lines'));

        $this->created                = self::stringFrom($data, "created");
        $this->modified               = self::stringFrom($data, "modified");
        $this->id                     = self::intFrom($data, "id");
        $this->price_display          = self::stringFrom($data, "price_display");
        $this->sub_total              = self::floatFrom($data, "sub_total");
        $this->sub_total_display      = self::stringFrom($data, "sub_total_display");
        $this->tax                    = self::floatFrom($data, "tax");
        $this->tax_lines              = $this->sortArray($tax_lines, 'title');
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
