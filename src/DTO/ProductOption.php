<?php

namespace Stock2Shop\Share\DTO;


class ProductOption extends  AbstractBase
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
}
