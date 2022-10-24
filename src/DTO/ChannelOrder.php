<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelOrder extends DTO implements JsonSerializable, DTOInterface
{

    public function __construct(array $data)
    {
        // TODO
    }

    public static function createFromJSON(string $json): ChannelOrder
    {
        $data = json_decode($json, true);
        return new ChannelOrder($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return ChannelOrder[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelOrder((array)$item);
        }
        return $a;
    }
}
