<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeSystemOrderAddress = array{
 *     address1?: string|null,
 *     address2?: string|null,
 *     city?: string|null,
 *     client_id?: int|null,
 *     company?: string|null,
 *     country?: string|null,
 *     country_code?: string|null,
 *     created?: string|null,
 *     first_name?: string|null,
 *     id?: int|null,
 *     last_name?: string|null,
 *     modified?: string|null,
 *     phone?: string|null,
 *     province?: string|null,
 *     province_code?: string|null,
 *     zip?: string|null
 * }
 */
class SystemOrderAddress extends Address
{
    public ?int $id;
    public ?int $client_id;
    public ?string $created;
    public ?string $modified;

    /**
     * @param TypeSystemOrderAddress $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $this->id         = self::intFrom($data, "id");
        $this->client_id  = self::intFrom($data, 'client_id');
        $this->created    = self::stringFrom($data, 'created');
        $this->modified   = self::stringFrom($data, 'modified');
    }

    public static function createFromJSON(string $json): SystemOrderAddress
    {
        $data = json_decode($json, true);
        return new SystemOrderAddress($data);
    }



    /**
     * @return SystemOrderAddress[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemOrderAddress((array)$item);
        }
        return $a;
    }
}
