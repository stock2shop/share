<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelVariant extends SystemVariant
{
    public ChannelVariantChannel $channel;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->channel = new ChannelVariantChannel(self::arrayFrom($data, 'channel'));
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
