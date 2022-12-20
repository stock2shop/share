<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class OrderParams extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $key;
    public ?string $value;

    /**
     * OrderParams constructor.
     */
    public function __construct(array $data)
    {
        $this->key           = self::stringFrom($data, "key");
        $this->value         = self::stringFrom($data, "value");
    }

    public static function createFromJSON(string $json): OrderParams
    {
        $data = json_decode($json, true);
        return new OrderParams($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return OrderParams[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new OrderParams((array)$item);
        }
        return $a;
    }
}
