<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeOrderMeta = array{
 *     key?: string|null,
 *     value?: string|null
 * }
 */
class OrderMeta extends DTO
{
    public ?string $key;
    public ?string $value;

    /**
     * OrderMeta constructor.
     * @param TypeOrderMeta $data
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
