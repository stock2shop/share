<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypeCustomerAddress = array{
 *     address1?: string|null,
 *     address2?: string|null,
 *     address_code?: string|null,
 *     channel_id?: int|null,
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
 *     type?: string|null,
 *     zip?: string|null
 * }
 */
class CustomerAddress extends Address implements JsonSerializable, DTOInterface
{
    public ?string $address_code;
    public ?bool $default;

    /**
     * @param TypeCustomerAddress $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $this->address_code = self::stringFrom($data, 'address_code');
        $this->default      = self::boolFrom($data, 'default');
    }

    public static function createFromJSON(string $json): CustomerAddress
    {
        $data = json_decode($json, true);
        return new CustomerAddress($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return CustomerAddress[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new CustomerAddress((array)$item);
        }
        return $a;
    }
}
