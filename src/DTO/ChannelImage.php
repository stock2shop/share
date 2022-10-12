<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class ChannelImage extends SystemImage implements \JsonSerializable, DTOInterface
{
    public ChannelImageChannel $channel;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->channel = new ChannelImageChannel(self::arrayFrom($data, 'channel'));
    }

    static function createFromJSON(string $json): ChannelImage
    {
        $data = json_decode($json, true);
        return new ChannelImage($data);
    }

    public function jsonSerialize(): array
    {
        return (array) $this;
    }
}
