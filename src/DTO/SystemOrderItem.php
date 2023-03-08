<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-import-type TypeSystemFulfillmentLineItem from SystemFulfillmentLineItem
 * @psalm-import-type TypeOrderItemTax from OrderItemTax
 * @psalm-type TypeSystemOrderItem = array{
 *     created?: string|null,
 *     fulfillments: TypeSystemFulfillmentLineItem,
 *     modified?: string|null,
 *     product_id?: int|null,
 *     variant_id?: int|null,
 *     id?: int|null,
 *     source_id?: int|null,
 *     source_variant_code?: string|null,
 *     price_display?: string|null,
 *     total_discount?: float|null,
 *     total_discount_display?: string|null,
 *     tax_per_unit_display?: string|null,
 *     tax?: float|null,
 *     tax_display?: string|null,
 *     tax_lines: TypeOrderItemTax,
 *     sub_total?: float|null,
 *     tax_per_unit?: float|null,
 *     sub_total_display?: string|null,
 *     total?: float|null,
 *     total_display?: string|null,
 *     barcode?: string|null,
 *     grams?: int|null,
 *     price?: float|null,
 *     qty?: int|null,
 *     sku?: string|null,
 *     title?: string|null,
 *     total_discount?: float|null
 * }
 */
class SystemOrderItem extends OrderItem implements JsonSerializable, DTOInterface
{
    public ?string $created;
    /** @var SystemFulfillmentLineItem[] $fulfillments */
    public array $fulfillments;
    public ?string $modified;
    public ?int $product_id;
    public ?int $variant_id;
    public ?int $id;
    public ?int $source_id;
    public ?string $source_variant_code;
    public ?string $price_display;
    public ?float $total_discount;
    public ?string $total_discount_display;
    public ?string $tax_per_unit_display;
    public ?float $tax;
    public ?string $tax_display;
    /** @var OrderItemTax[] $tax_lines */
    public array $tax_lines;
    public ?float $sub_total;
    public ?float $tax_per_unit;
    public ?string $sub_total_display;
    public ?float $total;
    public ?string $total_display;

    /**
     * @param TypeSystemOrderItem $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $fulfillments = SystemFulfillmentLineItem::createArray(self::arrayFrom($data, 'fulfillments'));
        $tax_lines    = OrderItemTax::createArray(self::arrayFrom($data, 'tax_lines'));

        $this->created                = self::stringFrom($data, "created");
        $this->fulfillments           = self::sortArray($fulfillments, 'sku');
        $this->modified               = self::stringFrom($data, "modified");
        $this->product_id             = self::intFrom($data, 'product_id');
        $this->variant_id             = self::intFrom($data, 'variant_id');
        $this->id                     = self::intFrom($data, 'id');
        $this->source_id              = self::intFrom($data, 'source_id');
        $this->source_variant_code    = self::stringFrom($data, 'source_variant_code');
        $this->price_display          = self::stringFrom($data, 'price_display');
        $this->total_discount         = self::floatFrom($data, 'total_discount');
        $this->total_discount_display = self::stringFrom($data, 'total_discount_display');
        $this->tax_per_unit_display   = self::stringFrom($data, 'tax_per_unit_display');
        $this->tax                    = self::floatFrom($data, 'tax');
        $this->tax_per_unit           = self::floatFrom($data, 'tax_per_unit');
        $this->tax_display            = self::stringFrom($data, 'tax_display');
        $this->tax_lines              = self::sortArray($tax_lines, 'title');
        $this->sub_total              = self::floatFrom($data, 'sub_total');
        $this->sub_total_display      = self::stringFrom($data, 'sub_total_display');
        $this->total                  = self::floatFrom($data, 'total');
        $this->total_display          = self::stringFrom($data, 'total_display');
        $this->fulfillments           = self::sortArray($fulfillments, 'fulfillment_id');
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): SystemOrderItem
    {
        $data = json_decode($json, true);
        return new SystemOrderItem($data);
    }

    /**
     * @return SystemOrderItem[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemOrderItem((array)$item);
        }
        return $a;
    }
}
