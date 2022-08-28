<?php

namespace Stock2Shop\Share\DTO;

class SystemImage extends Image
{

    /** @var int $id */
    protected $id;

    /** @var bool $active */
    protected $active;

    public function __construct(array $data)
    {
        parent::__construct($data);
        $this->active = self::boolFrom($data, "active");
        $this->id     = self::intFrom($data, 'id');
    }

    public function setID($arg)
    {
        $this->id = self::toInt($arg);
    }

    public function setActive($arg)
    {
        $this->active = self::toBool($arg);
    }

    public function getID()
    {
        return $this->id;
    }

    public function getActive()
    {
        return $this->active;
    }
}
