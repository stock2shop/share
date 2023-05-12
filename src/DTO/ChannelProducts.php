<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-import-type TypeChannelProduct from ChannelProduct
 * @psalm-type TypeChannelProducts = array{
 *     channel_products?: array<int, TypeChannelProduct>|array<int, ChannelProduct>
 * }
 */
class ChannelProducts extends DTO
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
