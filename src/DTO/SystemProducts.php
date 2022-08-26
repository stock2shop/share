<?php

namespace Stock2Shop\Share\DTO;

class SystemProducts extends AbstractBase
{
    /** @var SystemProduct[] $system_products */
    protected $system_products;

    /**
     * @param array $data
     */
    public function __construct(array $data)
    {
        $this->system_products = SystemProduct::createArray(self::arrayFrom($data, 'system_products'));
    }

    /**
     * @param array $arg
     * @return void
     */
    public function setSystemProducts(array $arg)
    {
        $this->system_products = SystemProduct::createArray($arg);
    }
}
