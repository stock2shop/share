<?php

namespace Stock2Shop\Share\DTO;

class ChannelProducts extends AbstractBase
{
    /** @var ChannelProduct[] $channel_products */
    protected $channel_products;

    public function __construct(array $data)
    {
        $this->channel_products = ChannelProduct::createArray(self::arrayFrom($data, 'channel_products'));
    }

    public function setChannelProducts(array $arg)
    {
        $this->channel_products = ChannelProduct::createArray($arg['channel_products'] ?? []);
    }

    public function getChannelProducts(): array
    {
        return $this->channel_products;
    }

}
