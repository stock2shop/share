<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelProductChannel extends DTO
{
    protected ?int      $channel_id;
    protected ?string   $channel_product_code;
    protected ?bool     $delete;
    protected ?bool     $success;
    protected ?string   $synced;

    public function __construct(array $data)
    {
        $this->channel_id           = self::intFrom($data, 'channel_id');
        $this->channel_product_code = self::stringFrom($data, 'channel_product_code');
        $this->delete               = self::boolFrom($data, 'delete');
        $this->success              = self::boolFrom($data, 'success');
        $this->synced               = self::stringFrom($data, 'synced');
    }

    public function setChannelID($arg): void
    {
        $this->channel_id = self::toInt($arg);
    }

    public function setChannelProductCode($arg): void
    {
        $this->channel_product_code = self::toString($arg);
    }

    public function setDelete($arg): void
    {
        $this->delete = self::toBool($arg);
    }

    public function setSuccess($arg): void
    {
        $this->success = self::toBool($arg);
    }

    public function setSynced($arg): void
    {
        $this->synced = self::toString($arg);
    }

    public function getChannelID(): ?int
    {
        return $this->channel_id;
    }

    public function getChannelProductCode(): ?string
    {
        return $this->channel_product_code;
    }

    public function getDelete(): ?bool
    {
        return $this->delete;
    }

    public function getSuccess(): ?bool
    {
        return $this->success;
    }

    public function getSynced(): ?string
    {
        return $this->synced;
    }

    /**
     * Returns true if a product is considered synced with a channel.
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
