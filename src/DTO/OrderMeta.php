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
}
