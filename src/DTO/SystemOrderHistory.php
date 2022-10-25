<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemOrderHistory extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $instruction;
    public ?string $storage_code;


    public function __construct(array $data)
    {
        $this->instruction  = self::stringFrom($data, "instruction");
        $this->storage_code = self::stringFrom($data, "storage_code");
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): SystemOrderHistory
    {
        $data = json_decode($json, true);
        return new SystemOrderHistory($data);
    }

    /**
     * @return SystemOrderHistory[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemOrderHistory((array)$item);
        }
        return $a;
    }
}
