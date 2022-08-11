<?php

namespace stock2shop\share\dto;

class ChannelProducts extends Base
{
    /** @var ChannelProduct[] $channel_products */
    public $channel_products;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->channel_products     = ChannelProduct::createArray(self::arrayFrom($data, 'channel_products'));
    }
}
