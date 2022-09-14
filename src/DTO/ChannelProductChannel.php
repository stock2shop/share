<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelProductChannel extends DTO
{
    public ?int      $channel_id;
    public ?string   $channel_product_code;
    public ?bool     $delete;
    public ?bool     $success;
    public ?string   $synced;

    public function __construct(array $data)
    {
        $this->channel_id = self::intFrom($data, 'channel_id');
        $this->channel_product_code = self::stringFrom($data, 'channel_product_code');
        $this->delete = self::boolFrom($data, 'delete');
        $this->success = self::boolFrom($data, 'success');
        $this->synced = self::stringFrom($data, 'synced');
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
