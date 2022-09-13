<?php

namespace Stock2Shop\Share\DTO;

class ChannelProductChannel extends DTO
{

    /** @var int|null $channel_id */
    protected $channel_id;

    /** @var string $channel_product_code */
    protected $channel_product_code;

    /** @var bool|null $delete */
    protected $delete;

    /** @var bool|null $success */
    protected $success;

    /** @var string|null $synced */
    protected $synced;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->channel_id           = self::intFrom($data, 'channel_id');
        $this->channel_product_code = self::stringFrom($data, 'channel_product_code');
        $this->delete               = self::boolFrom($data, 'delete');
        $this->success              = self::boolFrom($data, 'success');
        $this->synced               = self::stringFrom($data, 'synced');
    }

    public function setChannelID($arg)
    {
        $this->channel_id = self::toInt($arg);
    }

    public function setChannelProductCode($arg)
    {
        $this->channel_product_code = self::toString($arg);
    }

    public function setDelete($arg)
    {
        $this->delete = self::toBool($arg);
    }

    public function setSuccess($arg)
    {
        $this->success = self::toBool($arg);
    }

    public function setSynced($arg)
    {
        $this->synced = self::toString($arg);
    }

    public function getChannelID()
    {
        return $this->channel_id;
    }

    public function getChannelProductCode()
    {
        return $this->channel_product_code;
    }

    public function getDelete()
    {
        return $this->delete;
    }

    public function getSuccess()
    {
        return $this->success;
    }

    public function getSynced()
    {
        return $this->synced;
    }

    /**
     * Returns true if a product is considered synced with a channel.
     *
     * @return bool
     */
    public function hasSyncedToChannel(): bool
    {
        return (
            $this->success &&
            is_string($this->channel_product_code) &&
            $this->channel_product_code !== ''
        );
    }

}
