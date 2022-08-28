<?php

namespace Stock2Shop\Share\DTO;

class QtyAvailability extends AbstractBase
{
    /** @var string|null $description */
    protected $description;

    /** @var float|null $qty */
    protected $qty;

    function __construct(array $data)
    {
        $this->description = self::stringFrom($data, "description");
        $this->qty         = self::intFrom($data, "qty");
    }

    public function setDescription($arg)
    {
        $this->description = self::toString($arg);
    }

    public function setQty($arg)
    {
        $this->qty = self::toInt($arg);
    }

    public function getDescription()
    {
        return $this->description;
    }

    public function getQty()
    {
        return $this->qty;
    }

}
