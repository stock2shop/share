<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypeChannelOrderAddress = array{
 *     address1?: string|null,
 *     address2?: string|null,
 *     city?: string|null,
 *     company?: string|null,
 *     country?: string|null,
 *     country_code?: string|null,
 *     first_name?: string|null,
 *     last_name?: string|null,
 *     phone?: string|null,
 *     province?: string|null,
 *     province_code?: string|null,
 *     zip?: string|null
 *}
 */
class ChannelOrderAddress extends Address implements JsonSerializable, DTOInterface
{
    /**
     * @param TypeChannelOrderAddress $data
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
