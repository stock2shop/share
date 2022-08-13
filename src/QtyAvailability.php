<?php

namespace Stock2Shop\DTO;

class QtyAvailability extends  AbstractBase
{
    /** @var string|null $description */
    public $description;

    /** @var float|null $qty */
    public $qty;

    /**
     * QtyAvailabilityItem constructor.
     * @param array $data
     */
    function __construct(array $data)
    {
        $this->description = self::stringFrom($data, "description");
        $this->qty         = self::intFrom($data, "qty");
    }

    /**
     * @param array $data
     * @return QtyAvailability[]
     */
    static function createArray(array $data): array
    {
        $a = [];
        foreach ($data as $item) {
            $pmd = new QtyAvailability((array)$item);
            $a[] = $pmd;
        }
        return $a;
    }
}
