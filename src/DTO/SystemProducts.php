<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

class SystemProducts extends DTO implements JsonSerializable, DTOInterface
{
    /** @var SystemProduct[] $system_products */
    public array $system_products;

    public function __construct(array $data)
    {
        $this->system_products = SystemProduct::createArray(self::arrayFrom($data, 'system_products'));
    }

    static function createFromJSON(string $json): SystemProducts
    {
        $data = json_decode($json, true);
        return new SystemProducts($data);
    }

    public function jsonSerialize(): array
    {
        return (array) $this;
    }

    /**
     * Creates an array of class instances, instantiated with data.
     * @return SystemProducts[]
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemProducts((array) $item);
        }
        return $a;
    }
}
