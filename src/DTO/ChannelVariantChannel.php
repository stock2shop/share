<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypeChannelVariantChannel = array{
 *     channel_id?: int|null,
 *     channel_variant_code?: string|null,
 *     delete?: bool|null,
 *     success?: bool|null
 * }
 */
class ChannelVariantChannel extends DTO implements JsonSerializable, DTOInterface
{
    public ?int $channel_id;
    public ?string $channel_variant_code;
    public ?bool $delete;
    public ?bool $success;

    /**
     * @param TypeChannelVariantChannel $data
     */
    public function __construct(array $data)
    {
        $this->channel_id           = self::intFrom($data, 'channel_id');
        $this->channel_variant_code = self::stringFrom($data, 'channel_variant_code');
        $this->delete               = self::boolFrom($data, 'delete');
        $this->success              = self::boolFrom($data, 'success');
    }

    /**
     * Returns true if a product is considered synced with a channel.
     */
    public function hasSyncedToChannel(): bool
    {
        return (
            $this->success &&
            is_string($this->channel_variant_code) &&
            $this->channel_variant_code !== ''
        );
    }

    public static function createFromJSON(string $json): ChannelVariantChannel
    {
        $data = json_decode($json, true);
        return new ChannelVariantChannel($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return ChannelVariantChannel[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelVariantChannel((array)$item);
        }
        return $a;
    }
}
