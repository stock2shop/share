<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypeChannelOrderShippingLine = array{
 *     price?: float|null,
 *     title?: string|null
 * }
 */
class ChannelOrderShippingLine extends OrderShippingLine implements JsonSerializable, DTOInterface
{
    /**
     * @param TypeChannelOrderShippingLine $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);
    }

    public static function createFromJSON(string $json): ChannelOrderShippingLine
    {
        $data = json_decode($json, true);
        return new ChannelOrderShippingLine($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return ChannelOrderShippingLine[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelOrderShippingLine((array)$item);
        }
        return $a;
    }
}
