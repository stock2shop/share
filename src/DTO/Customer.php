<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class Customer extends DTO implements JsonSerializable, DTOInterface
{
    public ?bool $accepts_marketing;
    public ?string $email;
    public ?string $first_name;
    public ?string $last_name;

    public function __construct(array $data)
    {
        $this->accepts_marketing = self::boolFrom($data, 'accepts_marketing');
        $this->email             = self::stringFrom($data, 'email');
        $this->first_name        = self::stringFrom($data, 'first_name');
        $this->last_name         = self::stringFrom($data, 'last_name');
    }

    public static function createFromJSON(string $json): Customer
    {
        $data = json_decode($json, true);
        return new Customer($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return Customer[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new Customer((array)$item);
        }
        return $a;
    }
}
