<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelImage extends Image
{
    public readonly ChannelImageChannel $channel;
    public readonly ?int $id;
    public readonly ?bool $active;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->channel = new ChannelImageChannel(self::arrayFrom($data, 'channel'));
        $this->active  = self::boolFrom($data, "active");
        $this->id      = self::intFrom($data, 'id');
    }
}
