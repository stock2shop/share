<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelOrderItem extends OrderItem implements JsonSerializable, DTOInterface
{
    public ?string $channel_product_code;
    public ?string $channel_variant_code;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->channel_product_code = self::stringFrom($data, 'channel_product_code');
        $this->channel_variant_code = self::stringFrom($data, 'channel_variant_code');
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
