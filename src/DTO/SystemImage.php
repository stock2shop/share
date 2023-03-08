<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

use JsonSerializable;

/**
 * @psalm-type TypeSystemImage = array{
 *     id?: int|null,
 *     active?: bool|null,
 *     src?: string|null
 * }
 */
class SystemImage extends Image implements JsonSerializable, DTOInterface
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

    public static function createFromJSON(string $json): SystemImage
    {
        $data = json_decode($json, true);
        return new SystemImage($data);
    }

    public function jsonSerialize(): array
    {
        return (array)$this;
    }

    /**
     * @return SystemImage[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new SystemImage((array)$item);
        }
        return $a;
    }
}
