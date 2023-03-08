<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypeSystemOrderHistory = array{
 *     instruction?: string|null,
 *     storage_code?: string|null,
 *     created?: string|null,
 *     modified?: string|null
 * }
 */
class SystemOrderHistory extends DTO implements JsonSerializable, DTOInterface
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

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    public static function createFromJSON(string $json): SystemOrderHistory
    {
        $data = json_decode($json, true);
        return new SystemOrderHistory($data);
    }

    /**
     * @return SystemOrderHistory[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemOrderHistory((array)$item);
        }
        return $a;
    }
}
