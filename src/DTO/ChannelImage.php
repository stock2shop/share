<?php

namespace Stock2Shop\Share\DTO;

class ChannelImage extends  SystemImage
{
    /** @var string|null $channel_image_code */
    public $channel_image_code;

    /** @var bool|null $delete */
    public $delete;

    /** @var bool|null $success */
    public $success;

    /**
     * ChannelImage constructor.
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->channel_image_code = self::stringFrom($data, "channel_image_code");
        $this->delete             = self::boolFrom($data, 'delete');
        $this->success            = self::boolFrom($data, 'success');
    }

    /**
     * Returns true if the image is synced with a channel.
     *
     * @return bool
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
