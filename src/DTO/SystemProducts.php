<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class SystemProducts extends DTO
{
    /** @var SystemProduct[] $system_products */
    public readonly array $system_products;

    public function __construct(array $data)
    {
        $this->system_products = SystemProduct::createArray(self::arrayFrom($data, 'system_products'));
    }
}
