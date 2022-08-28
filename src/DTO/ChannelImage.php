<?php

namespace Stock2Shop\Share\DTO;

class ChannelImage extends SystemImage
{
    /** @var ChannelImageChannel $channel */
    protected $channel;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->channel = new ChannelImageChannel(self::arrayFrom($data, 'channel'));
    }

    public function setChannel($arg)
    {
        $this->channel = new ChannelImageChannel($arg);
    }

    public function getChannel()
    {
        return $this->channel;
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
