<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class Address extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $address1;
    public ?string $address2;
    public ?string $address_code;
    public ?string $city;
    public ?string $country_code;
    public ?string $company;
    public ?string $country;
    public ?bool $default;
    public ?string $first_name;
    public ?string $last_name;
    public ?string $phone;
    public ?string $province;
    public ?string $province_code;
    public ?string $zip;
    public ?string $type;


    public function __construct(array $data)
    {
        $this->address1      = self::stringFrom($data, 'address1');
        $this->address2      = self::stringFrom($data, 'address2');
        $this->address_code  = self::stringFrom($data, 'address_code');
        $this->city          = self::stringFrom($data, 'city');
        $this->country_code  = self::stringFrom($data, 'country_code');
        $this->company       = self::stringFrom($data, 'company');
        $this->country       = self::stringFrom($data, 'country');
        $this->default       = self::boolFrom($data, 'default');
        $this->first_name    = self::stringFrom($data, 'first_name');
        $this->last_name     = self::stringFrom($data, 'last_name');
        $this->phone         = self::stringFrom($data, 'phone');
        $this->province      = self::stringFrom($data, 'province');
        $this->province_code = self::stringFrom($data, 'province_code');
        $this->type          = self::stringFrom($data, 'type');
        $this->zip           = self::stringFrom($data, 'zip');
    }

    public static function createFromJSON(string $json): Address
    {
        $data = json_decode($json, true);
        return new Address($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return Address[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new Address((array)$item);
        }
        return $a;
    }
}
