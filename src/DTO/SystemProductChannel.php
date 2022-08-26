<?php

namespace Stock2Shop\Share\DTO;

class SystemProductChannel extends SystemChannel
{
    /** @var string|null $created */
    public $channel_product_code;

    /** @var string|null $synced */
    public $synced;


    /**
     * Channel constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->channel_product_code = static::stringFrom($data, 'channel_product_code');
        $this->synced               = static::stringFrom($data, 'synced');
    }
}
