<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelOrder extends Order implements JsonSerializable, DTOInterface
{
    public ChannelOrderAddress $billing_address;
    public ChannelOrderCustomer $customer;
    public ?string $instruction;
    /** @var ChannelOrderLineItem[] */
    public array $line_items;
    /** @var OrderMeta[] */
    public array $meta;
    public ChannelOrderAddress $shipping_address;
    /** @var ChannelOrderShippingLine[] */
    public array $shipping_lines;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $line_items     = ChannelOrderLineItem::createArray(self::arrayFrom($data, 'line_items'));
        $meta           = OrderMeta::createArray(self::arrayFrom($data, 'meta'));
        $shipping_lines = OrderShippingLine::createArray(self::arrayFrom($data, 'shipping_lines'));

        $this->billing_address  = new ChannelOrderAddress(self::arrayFrom($data, 'billing_address'));
        $this->customer         = new ChannelOrderCustomer(self::arrayFrom($data, 'customer'));
        $this->instruction      = self::stringFrom($data, 'instruction');
        $this->line_items       = $this->sortArray($line_items, 'channel_variant_code');
        $this->meta             = $this->sortArray($meta, 'key');
        $this->shipping_address = new ChannelOrderAddress(self::arrayFrom($data, 'shipping_address'));
        $this->shipping_lines   = $this->sortArray($shipping_lines, 'title');
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): ChannelOrder
    {
        $data = json_decode($json, true);
        return new ChannelOrder($data);
    }

    /**
     * @return ChannelOrder[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelOrder((array)$item);
        }
        return $a;
    }
}
