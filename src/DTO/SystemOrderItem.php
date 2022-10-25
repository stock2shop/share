<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemOrderItem extends OrderItem implements JsonSerializable, DTOInterface
{
    public ?string $code;
    public ?int $product_id;
    public ?int $variant_id;
    public ?int $source_id;
    public ?string $source_variant_code;
    public ?string $price_display;
    public ?string $total_discount_display;
    public ?string $tax_per_unit_display;
    public ?float $tax;
    public ?string $tax_display;
    public ?float $sub_total;
    public ?float $tax_per_unit;
    public ?string $sub_total_display;
    public ?float $total;
    public ?string $total_display;
    /** @var SystemOrderItemFulfillment[] $fulfillment */
    public array $fulfillments;

    public const CODE_DEFAULT = self::CODE_ORDER_ITEM;
    public const CODE_SHIPPING_LINE = 'ship';
    public const CODE_ORDER_ITEM = 'item';
    public const CODES_ALLOWED = [
        self::CODE_ORDER_ITEM,
        self::CODE_SHIPPING_LINE
    ];

    public function __construct(array $data)
    {
        parent::__construct($data);

        $fulfillments = SystemOrderItemFulfillment::createArray(self::arrayFrom($data, 'fulfillments'));

        $this->code                   = self::stringFrom($data, 'code');
        $this->product_id             = self::intFrom($data, 'product_id');
        $this->variant_id             = self::intFrom($data, 'variant_id');
        $this->source_id              = self::intFrom($data, 'source_id');
        $this->source_variant_code    = self::stringFrom($data, 'source_variant_code');
        $this->price_display          = self::stringFrom($data, 'price_display');
        $this->total_discount         = self::floatFrom($data, 'total_discount');
        $this->total_discount_display = self::stringFrom($data, 'total_discount_display');
        $this->tax_per_unit_display   = self::stringFrom($data, 'tax_per_unit_display');
        $this->tax                    = self::floatFrom($data, 'tax');
        $this->tax_per_unit           = self::floatFrom($data, 'tax_per_unit');
        $this->tax_display            = self::stringFrom($data, 'tax_display');
        $this->sub_total              = self::floatFrom($data, 'sub_total');
        $this->sub_total_display      = self::stringFrom($data, 'sub_total_display');
        $this->total                  = self::floatFrom($data, 'total');
        $this->total_display          = self::stringFrom($data, 'total_display');
        $this->fulfillments           = $this->sortArray($fulfillments, 'fulfillment_id');
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

    /**
     * Is Valid Code
     *
     * Checks whether the value exists in
     * the class constant.
     *
     * @param string $code
     * @return bool
     */
    public static function isValidCode(string $code): bool
    {
        return in_array($code, self::CODES_ALLOWED);
    }
}
