<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelVariant extends SystemVariant implements JsonSerializable, DTOInterface
{
    public ChannelVariantChannel $channel;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->channel = new ChannelVariantChannel(self::arrayFrom($data, 'channel'));
    }

    static function createFromJSON(string $json): ChannelVariant
    {
        $data = json_decode($json, true);
        return new ChannelVariant($data);
    }

    public function jsonSerialize(): array
    {
        return (array) $this;
    }

    /**
     * Creates an array of class instances, instantiated with data.
     * @return ChannelVariant[]
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelVariant((array) $item);
        }
        return $a;
    }
}
