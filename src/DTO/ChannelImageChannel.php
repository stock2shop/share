<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelImageChannel extends DTO
{
    public readonly ?int $channel_id;
    public ?string $channel_image_code;
    public readonly ?bool $delete;
    public ?bool $success;

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
}
