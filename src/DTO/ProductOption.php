<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeProductOption = array{
 *     name?: string|null,
 *     position?: int|null
 * }
 */
class ProductOption extends DTO
{
    public ?string $name;
    public ?int $position;

    /**
     * @param TypeProductOption $data
     */
    public function __construct(array $data)
    {
        $this->name     = self::stringFrom($data, "name");
        $this->position = self::intFrom($data, "position");
    }
}
