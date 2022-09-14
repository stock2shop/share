<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelProducts extends DTO
{
    /** @var ChannelProduct[] $channel_products */
    public array $channel_products;

    public function __construct(array $data)
    {
        $this->channel_products = ChannelProduct::createArray(self::arrayFrom($data, 'channel_products'));
    }
}
