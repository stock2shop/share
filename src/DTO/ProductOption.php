<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;


class ProductOption extends DTO
{
    public ?string $name;
    public ?int $position;

    function __construct(array $data)
    {
        $this->name     = self::stringFrom($data, "name");
        $this->position = self::intFrom($data, "position");
    }
}
