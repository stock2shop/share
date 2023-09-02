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
}
