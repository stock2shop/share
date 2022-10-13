<?php

declare(strict_types=1);

namespace Stock2Shop\Share\DTO;



use JsonSerializable;

class QtyAvailability extends DTO implements JsonSerializable, DTOInterface
{
    public ?string $description;
    public ?float $qty;

    function __construct(array $data)
    {
        $this->description = self::stringFrom($data, "description");
        $this->qty         = self::intFrom($data, "qty");
    }

    static function createFromJSON(string $json): QtyAvailability
    {
        $data = json_decode($json, true);
        return new QtyAvailability($data);
    }

    public function jsonSerialize(): array
    {
        return (array) $this;
    }

    /**
     * Creates an array of class instances, instantiated with data.
     * @return QtyAvailability[]
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $a[] = new QtyAvailability((array) $item);
        }
        return $a;
    }
}
