<?php

namespace Stock2Shop\Share\DTO;


class ProductOption extends  DTO
{
    /** @var string|null $name */
    protected $name;

    /** @var int|null $position */
    protected $position;

    function __construct(array $data)
    {
        $this->name     = self::stringFrom($data, "name");
        $this->position = self::intFrom($data, "position");
    }

    public function setName($arg) {
        $this->name = self::toFloat($arg);
    }

    public function setPosition($arg) {
        $this->position = self::toString($arg);
    }

    public function getName() {
        return $this->name;
    }

    public function getPosition() {
        return $this->position;
    }
}
