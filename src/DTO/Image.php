<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeImage = array{
 *     src?: string|null
 * }
 */
class Image extends DTO
{
    public ?string $src;

    /**
     * @param TypeImage $data
     */
    public function __construct(array $data)
    {
        $this->src = self::stringFrom($data, 'src');
    }

    public static function createFromJSON(string $json): Image
    {
        $data = json_decode($json, true);
        return new Image($data);
    }



    /**
     * @return Image[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new Image((array)$item);
        }
        return $a;
    }
}
