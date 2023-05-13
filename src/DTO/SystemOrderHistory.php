<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeSystemOrderHistory = array{
 *     created?: string|null,
 *     instruction?: string|null,
 *     modified?: string|null,
 *     storage_code?: string|null
 * }
 */
class SystemOrderHistory extends DTO
{
    public ?string $instruction;
    public ?string $storage_code;
    public ?string $created;
    public ?string $modified;

    /**
     * @param TypeSystemOrderHistory $data
     */
    public function __construct(array $data)
    {
        $this->instruction  = self::stringFrom($data, "instruction");
        $this->storage_code = self::stringFrom($data, "storage_code");
        $this->created      = self::stringFrom($data, "created");
        $this->modified     = self::stringFrom($data, "modified");
    }
}
