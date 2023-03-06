<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/** TODO Confirm how to assign types when class extends some other class */
/**
 * @psalm-import-type TypeAddress from Address
 */
class ChannelOrderAddress extends Address implements JsonSerializable, DTOInterface
{
    /** TODO Confirm how to assign types when class extends some other class */
    /**
     * @param TypeAddress $data
     */
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
