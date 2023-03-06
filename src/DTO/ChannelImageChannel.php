<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypeChannelImageChannel = array{
 *     channel_id?: int,
 *     channel_image_code?: string,
 *     delete?: bool,
 *     success?: bool
 * }
 */

class ChannelImageChannel extends DTO implements JsonSerializable, DTOInterface
{
    public ?int $channel_id;
    public ?string $channel_image_code;
    public ?bool $delete;
    public ?bool $success;

    /**
     * @param TypeChannelImageChannel $data
     */
    public function __construct(array $data)
    {
        $this->channel_id         = self::intFrom($data, 'channel_id');
        $this->channel_image_code = self::stringFrom($data, 'channel_image_code');
        $this->delete             = self::boolFrom($data, 'delete');
        $this->success            = self::boolFrom($data, 'success');
    }

    /**
     * Returns true if the image is synced with a channel.
     */
    public function hasSyncedToChannel(): bool
    {
        return (
            $this->success &&
            is_string($this->channel_image_code) &&
            $this->channel_image_code !== ''

        );
    }

    public static function createFromJSON(string $json): ChannelImageChannel
    {
        $data = json_decode($json, true);
        return new ChannelImageChannel($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return ChannelImageChannel[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelImageChannel((array)$item);
        }
        return $a;
    }
}
