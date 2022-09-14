<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelProducts extends DTO
{
    /** @var ChannelProduct[] $channel_products */
    protected array $channel_products;

    public function __construct(array $data)
    {
        $this->channel_products = ChannelProduct::createArray(self::arrayFrom($data, 'channel_products'));
    }

    public function setChannelProducts(array $arg): void
    {
        $this->channel_products = ChannelProduct::createArray($arg);
    }

    /** @return ChannelProduct[] */
    public function getChannelProducts(): array
    {
        return $this->channel_products;
    }

}
