<?php

namespace stock2shop\share\vo;



class ProductOption extends Base
{
    /** @var string|null $name */
    public $name;

    /** @var int|null $position */
    public $position;

    /**
     * ProductOption constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        $this->name     = self::stringFrom($data, "name");
        $this->position = self::intFrom($data, "position");
    }

    /**
     * @param array $data
     * @return ProductOption[]
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $pmd = new ProductOption((array)$item);
            $a[] = $pmd;
        }
        return $a;
    }
}
