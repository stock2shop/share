<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeSystemImage = array{
 *     active?: bool|null,
 *     id?: int|null,
 *     src?: string|null
 * }
 */
class SystemImage extends Image
{
    public ?int $id;
    public ?bool $active;

    /**
     * @param TypeSystemImage $data
     */
    public function __construct(array $data)
    {
        /** @psalm-suppress InvalidArgument */
        parent::__construct($data);

        $this->active = self::boolFrom($data, "active");
        $this->id     = self::intFrom($data, 'id');
    }
}
