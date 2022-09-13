<?php

namespace Stock2Shop\Share\DTO;

class SystemImage extends Image
{

    protected ?int  $id;
    protected ?bool $active;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->active = self::boolFrom($data, "active");
        $this->id     = self::intFrom($data, 'id');
    }

    public function setID($arg): void
    {
        $this->id = self::toInt($arg);
    }

    public function setActive($arg): void
    {
        $this->active = self::toBool($arg);
    }

    public function getID(): ?int
    {
        return $this->id;
    }

    public function getActive(): ?int
    {
        return $this->active;
    }
}
