<?php

namespace Stock2Shop\Share\DTO;

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

}
