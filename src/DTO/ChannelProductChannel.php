<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelProductChannel extends DTO implements JsonSerializable, DTOInterface
{
    public ?int $channel_id;
    public ?string $channel_product_code;
    public ?bool $delete;
    public ?bool $success;
    public ?string $synced;

    public function __construct(array $data)
    {
        $this->channel_id           = self::intFrom($data, 'channel_id');
        $this->channel_product_code = self::stringFrom($data, 'channel_product_code');
        $this->delete               = self::boolFrom($data, 'delete');
        $this->success              = self::boolFrom($data, 'success');
        $this->synced               = self::stringFrom($data, 'synced');
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

    static function createFromJSON(string $json): ChannelProductChannel
    {
        $data = json_decode($json, true);
        return new ChannelProductChannel($data);
    }

    public function jsonSerialize(): array
    {
        return (array) $this;
    }

    /**
     * @return ChannelProductChannel[]
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelProductChannel((array) $item);
        }
        return $a;
    }
}
