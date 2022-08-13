<?php

namespace Stock2Shop\DTO;

class ChannelProducts extends BaseAbstract
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
