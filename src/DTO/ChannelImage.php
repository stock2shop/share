<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelImage extends SystemImage
{
    public readonly ChannelImageChannel $channel;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->channel = new ChannelImageChannel(self::arrayFrom($data, 'channel'));
    }
}
