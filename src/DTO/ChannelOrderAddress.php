<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelOrderAddress extends Address implements JsonSerializable, DTOInterface
{
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    public static function createFromJSON(string $json): ChannelOrderAddress
    {
        $data = json_decode($json, true);
        return new ChannelOrderAddress($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return ChannelOrderAddress[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelOrderAddress((array)$item);
        }
        return $a;
    }
}
