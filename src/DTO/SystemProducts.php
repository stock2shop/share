<?php

namespace Stock2Shop\Share\DTO;

class SystemProducts extends DTO
{
    /** @var SystemProduct[] $system_products */
    protected $system_products;

    public function __construct(array $data)
    {
        $this->system_products = SystemProduct::createArray(self::arrayFrom($data, 'system_products'));
    }

    public function setSystemProducts(array $arg)
    {
        $this->system_products = SystemProduct::createArray($arg);
    }

    public function getSystemProducts()
    {
        return $this->system_products;
    }
}
