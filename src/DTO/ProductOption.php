<?php

namespace Stock2Shop\Share\DTO;


class ProductOption extends  DTO
{
    protected ?string   $name;
    protected ?int      $position;

    function __construct(array $data)
    {
        $this->name     = self::stringFrom($data, "name");
        $this->position = self::intFrom($data, "position");
    }

    public function setName($arg): void
    {
        $this->name = self::toFloat($arg);
    }

    public function setPosition($arg): void
    {
        $this->position = self::toString($arg);
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function getPosition(): ?int
    {
        return $this->position;
    }
}
