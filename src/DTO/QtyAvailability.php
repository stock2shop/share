<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

/**
 * @psalm-type TypeQtyAvailability = array{
 *     description?: string|null,
 *     qty?: int|null
 * }
 */
class QtyAvailability extends DTO
{
    public ?string $description;
    public ?int $qty;

    /**
     * @param TypeQtyAvailability $data
     */
    public function __construct(array $data)
    {
        $this->description = self::stringFrom($data, "description");
        $this->qty         = self::intFrom($data, "qty");
    }

    public static function createFromJSON(string $json): QtyAvailability
    {
        $data = json_decode($json, true);
        return new QtyAvailability($data);
    }



    /**
     * @return QtyAvailability[]
     */
    public static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new QtyAvailability((array)$item);
        }
        return $a;
    }
}
