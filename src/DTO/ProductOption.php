<?php
declare(strict_types=1);

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
        $this->name = self::toString($arg);
    }

    public function setPosition($arg): void
    {
        $this->position = self::toInt($arg);
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
