<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelOrderItem extends OrderItem implements JsonSerializable, DTOInterface
{
    public ?string $channel_variant_code;
    public array $tax_lines;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $tax_lines   = OrderItemTax::createArray(self::arrayFrom($data, 'tax_lines'));

        $this->channel_variant_code = self::stringFrom($data, 'channel_variant_code');
        $this->tax_lines = $this->sortArray($tax_lines, 'title');
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
