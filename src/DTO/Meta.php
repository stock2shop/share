<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypeMeta = array{
 *     key?: string|null,
 *     template_name?: string|null,
 *     value?: string|null
 * }
 *
 * This is used by many classes.
 * e.g. Customers, Products, Sources, Channels ...
 *
 * Class Meta
 * @package stock2shop\vo
 */
class Meta extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $key;
    public ?string $value;
    public ?string $template_name;

    /**
     * Meta constructor.
     * @param TypeMeta $data
     */
    public function __construct(array $data)
    {
        $this->key           = self::stringFrom($data, "key");
        $this->value         = self::stringFrom($data, "value");
        $this->template_name = self::stringFrom($data, "template_name");
    }

    public static function createFromJSON(string $json): Meta
    {
        $data = json_decode($json, true);
        return new Meta($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return Meta[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new Meta((array)$item);
        }
        return $a;
    }
}
