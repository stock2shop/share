<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * This is used by many classes.
 * e.g. Customers, Products, Sources, Channels ...
 *
 * @psalm-type TypeMeta = array{
 *     key?: string|null,
 *     template_name?: string|null,
 *     value?: string|null
 * }
 *
 */
class Meta extends DTO
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

//    /**
//     * @param array $data
//     * @return Metas
//     */
//    public static function createArray(array $data): Metas
//    {
//        return new Metas($data);
//    }
}
