<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemOrder extends Order implements JsonSerializable, DTOInterface
{
    public SystemOrderCustomer $customer;
    public ?int $customer_id;
    /** @var SystemOrderFulfillment[] $fulfillments */
    public array $fulfillments;
    /** @var SystemOrderHistory[] $history */
    public array $history;
    public ?int $id;
    public ?float $line_item_sub_total;
    public ?float $line_item_tax;
    /** @var SystemOrderItem[] $line_items */
    public array $line_items;
    /** @var Meta[] $meta */
    public array $meta;
    /** @var SystemOrderShippingLine[] $shipping_lines */
    public array $shipping_lines;
    public ?float $shipping_sub_total;
    public ?float $shipping_tax;
    public ?string $shipping_tax_display;
    public ?float $shipping_total;
    public ?string $shipping_total_display;
    /** @var OrderSource[] $sources */
    public array $sources;
    public ?string $status;
    public ?float $sub_total;
    public ?string $sub_total_display;
    public ?float $tax;
    public ?string $tax_display;
    public ?float $total;
    public ?string $total_discount_display;
    public ?string $total_display;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $fulfillments   = SystemOrderFulfillment::createArray(self::arrayFrom($data, "fulfillments"));
        $history        = SystemOrderHistory::createArray(self::arrayFrom($data, "history"));
        $line_items     = SystemOrderItem::createArray(self::arrayFrom($data, 'line_items'));
        $meta           = Meta::createArray(self::arrayFrom($data, "meta"));
        $shipping_lines = SystemOrderShippingLine::createArray(self::arrayFrom($data, 'shipping_lines'));
        $sources        = OrderSource::createArray(self::arrayFrom($data, 'sources'));

        $this->customer               = new SystemOrderCustomer(self::arrayFrom($data, "customer"));
        $this->customer_id            = self::intFrom($data, "customer_id");
        $this->id                     = self::intFrom($data, "id");
        $this->fulfillments           = $this->sortArray($fulfillments, 'fulfillmentservice_order_code');
        $this->history                = $this->sortArray($history, 'storage_code');
        $this->line_item_sub_total    = self::floatFrom($data, 'line_item_sub_total');
        $this->line_item_tax          = self::floatFrom($data, 'line_item_tax');
        $this->line_items             = $this->sortArray($line_items, 'source_variant_code');
        $this->meta                   = $this->sortArray($meta, 'key');
        $this->shipping_lines         = $this->sortArray($shipping_lines, 'price_display');
        $this->shipping_sub_total     = self::floatFrom($data, "shipping_sub_total");
        $this->shipping_tax           = self::floatFrom($data, "shipping_tax");
        $this->shipping_tax_display   = self::stringFrom($data, "shipping_tax_display");
        $this->shipping_total         = self::floatFrom($data, "shipping_total");
        $this->shipping_total_display = self::stringFrom($data, "shipping_total_display");
        $this->sources                = $this->sortArray($sources, 'source_order_code');
        $this->status                 = self::stringFrom($data, "status");
        $this->sub_total              = self::floatFrom($data, "sub_total");
        $this->sub_total_display      = self::stringFrom($data, "sub_total_display");
        $this->tax                    = self::floatFrom($data, "tax");
        $this->tax_display            = self::stringFrom($data, "tax_display");
        $this->total                  = self::floatFrom($data, "total");
        $this->total_discount_display = self::stringFrom($data, "total_discount_display");
        $this->total_display          = self::stringFrom($data, "total_display");
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): SystemOrder
    {
        $data = json_decode($json, true);
        return new SystemOrder($data);
    }

    /**
     * @return SystemOrder[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemOrder((array)$item);
        }
        return $a;
    }
}
