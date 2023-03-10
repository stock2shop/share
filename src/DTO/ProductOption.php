<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypeProductOption = array{
 *     name?: string|null,
 *     position?: int|null
 * }
 */
class ProductOption extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $name;
    public ?int $position;

    /**
     * @param TypeProductOption $data
     */
    public function __construct(array $data)
    {
        $this->name     = self::stringFrom($data, "name");
        $this->position = self::intFrom($data, "position");
    }

    public static function createFromJSON(string $json): ProductOption
    {
        $data = json_decode($json, true);
        return new ProductOption($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return ProductOption[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new ProductOption((array)$item);
        }
        return $a;
    }
}
