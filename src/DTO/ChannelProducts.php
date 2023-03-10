<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-import-type TypeChannelProduct from ChannelProduct
 * @psalm-type TypeChannelProducts = array{
 *     channel_products: TypeChannelProduct
 * }
 */
class ChannelProducts extends DTO implements JsonSerializable, DTOInterface
{
    /** @var ChannelProduct[] $channel_products */
    public array $channel_products;

    /**
     * @param TypeChannelProducts $data
     */
    public function __construct(array $data)
    {
        $this->channel_products = ChannelProduct::createArray(self::arrayFrom($data, 'channel_products'));
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): ChannelProducts
    {
        $data = json_decode($json, true);
        return new ChannelProducts($data);
    }

    /**
     * @return ChannelProducts[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelProducts((array)$item);
        }
        return $a;
    }
}
