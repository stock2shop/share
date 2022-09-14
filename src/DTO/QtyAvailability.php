<?php
declare(strict_types=1);

namespace Stock2Shop\Share\DTO;

class QtyAvailability extends DTO
{
    protected ?string $description;
    protected ?float $qty;

    function __construct(array $data)
    {
        $this->description = self::stringFrom($data, "description");
        $this->qty         = self::intFrom($data, "qty");
    }

    public function setDescription($arg): void
    {
        $this->description = self::toString($arg);
    }

    public function setQty($arg): void
    {
        $this->qty = self::toInt($arg);
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getQty(): ?float
    {
        return $this->qty;
    }

}
