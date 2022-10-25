<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemOrderCustomer extends Customer implements JsonSerializable, DTOInterface
{
    public ?string $channel_customer_code;

    public function __construct(array $data)
    {
        parent::__construct($data);

        $this->channel_customer_code = self::stringFrom($data, "channel_customer_code");
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): SystemOrderCustomer
    {
        $data = json_decode($json, true);
        return new SystemOrderCustomer($data);
    }

    /**
     * @return SystemOrderCustomer[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemOrderCustomer((array)$item);
        }
        return $a;
    }
}
