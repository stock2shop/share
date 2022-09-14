<?php

declare(strict_types=1);

namespace Stock2shop\Share\DTO;

/**
 *
 * This is used by many classes.
 * e.g. Customers, Products, Sources, Channels ...
 *
 * Class Meta
 * @package stock2shop\vo
 */
class Meta extends DTO
{
    public readonly ?string $key;
    public readonly ?string $value;
    public readonly ?string $template_name;

    /**
     * Meta constructor.
     */
    function __construct(array $data)
    {
        $this->key           = self::stringFrom($data, "key");
        $this->value         = self::stringFrom($data, "value");
        $this->template_name = self::stringFrom($data, "template_name");
    }
}
