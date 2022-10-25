<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;


class OrderMeta extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $key;
    public ?string $value;

    /**
     * OrderMeta constructor.
     */
    public function __construct(array $data)
    {
        $this->key           = self::stringFrom($data, "key");
        $this->value         = self::stringFrom($data, "value");
    }

    public static function createFromJSON(string $json): OrderMeta
    {
        $data = json_decode($json, true);
        return new OrderMeta($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return OrderMeta[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new OrderMeta((array)$item);
        }
        return $a;
    }
}
