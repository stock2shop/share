<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class ChannelOrderCustomer extends Customer implements JsonSerializable, DTOInterface
{
    public function __construct(array $data)
    {
        parent::__construct($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): ChannelOrderCustomer
    {
        $data = json_decode($json, true);
        return new ChannelOrderCustomer($data);
    }

    /**
     * @return ChannelOrderCustomer[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ChannelOrderCustomer((array)$item);
        }
        return $a;
    }
}
