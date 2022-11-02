<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelOrderLineItem extends OrderItem implements JsonSerializable, DTOInterface
{
    public ?string $channel_variant_code;
    /** @var OrderItemTax[] $tax_lines */
    public array $tax_lines;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $tax_lines = OrderItemTax::createArray(self::arrayFrom($data, 'tax_lines'));

        $this->channel_variant_code = self::stringFrom($data, 'channel_variant_code');
        $this->tax_lines            = self::sortArray($tax_lines, 'title');
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): ChannelOrderLineItem
    {
        $data = json_decode($json, true);
        return new ChannelOrderLineItem($data);
    }

    /**
     * @return ChannelOrderLineItem[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelOrderLineItem((array)$item);
        }
        return $a;
    }
}
